<?php

namespace App\Controller;

use App\Entity\Medicamento;
use App\Form\MedicamentoType;
use App\Repository\MedicamentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

#[Route('/')]
final class MedicamentosController extends AbstractController
{
    #[Route(name: 'app_dashboard', methods: ['GET'])]
    public function index(MedicamentoRepository $medicamentoRepository): Response
    {
        return $this->render('medicamentos/index.html.twig', [
            'medicamentos' => $medicamentoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medicamentos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $medicamento = new Medicamento();
        $form = $this->createForm(MedicamentoType::class, $medicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($medicamento);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medicamentos/new.html.twig', [
            'medicamento' => $medicamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medicamentos_show', methods: ['GET'])]
    public function show(Medicamento $medicamento): Response
    {
        return $this->render('medicamentos/show.html.twig', [
            'medicamento' => $medicamento,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medicamentos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medicamento $medicamento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MedicamentoType::class, $medicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medicamentos/edit.html.twig', [
            'medicamento' => $medicamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medicamentos_delete', methods: ['POST'])]
    public function delete(
        Request $request, 
        #[MapEntity(id: 'id')] ?Medicamento $medicamento, 
        EntityManagerInterface $entityManager
    ): Response {
        if (!$medicamento) {
            $this->addFlash('error', 'Medicamento não encontrado.');
            return $this->redirectToRoute('app_dashboard');
        }
    
        if ($this->isCsrfTokenValid('delete'.$medicamento->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($medicamento);
            $entityManager->flush();
            $this->addFlash('success', 'Medicamento removido com sucesso.');
        }
    
        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }
}