<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DevelopersController extends AbstractController
{
    #[Route('/developers', name: 'app_developers')]
    public function index(): Response
    {
        return $this->render('developers/index.html.twig', [
            'controller_name' => 'DevelopersController',
        ]);
    }
}
