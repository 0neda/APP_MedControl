<?php

	namespace App\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;

	class LembretesController extends AbstractController
	{
        #[Route('/lembrete', name: 'app_lembrete')]
        public function lembrete(): Response
        {
            return $this->render('components/_lembrete.html.twig', [
                'visible' => true
            ]);
        }
	}