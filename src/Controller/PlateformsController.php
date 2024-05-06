<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlateformsController extends AbstractController
{
    #[Route('/plateforms', name: 'app_plateforms')]
    public function index(): Response
    {
        return $this->render('plateforms/index.html.twig', [
            'controller_name' => 'PlateformsController',
        ]);
    }
}
