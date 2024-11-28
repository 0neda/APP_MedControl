<?php
namespace App\Controller;

use App\Entity\Registro;
use App\Form\RegistroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DocumentController extends AbstractController
{
    #[Route('/registros/upload', name: 'app_registros_upload', methods: ['GET', 'POST'])]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        $registro = new Registro();
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arquivoUpload = $form['file']->getData();
            if ($arquivoUpload) {
                $destination = $this->getParameter('upload_directory');
                
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }
                
                $newNomeArquivo = uniqid().'.'.$arquivoUpload->guessExtension();

                try {
                    $arquivoUpload->move($destination, $newNomeArquivo);
                    $registro->setNomeArquivo($newNomeArquivo);
                    
                    $entityManager->persist($registro);
                    $entityManager->flush();
                    
                    return $this->redirectToRoute('app_registros_list');
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erro ao fazer upload do arquivo');
                }
            }
        }

        return $this->render('registro/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/registros/list', name: 'app_registros_list', methods: ['GET', 'POST'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $registros = $entityManager->getRepository(Registro::class)->findAll();

        return $this->render('registro/index.html.twig', [
            'registros' => $registros,
        ]);
    }
}