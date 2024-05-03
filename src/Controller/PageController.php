<?php

namespace App\Controller;

use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(EntityManagerInterface $em): Response
    {
        $offers = $em->getRepository(Offers::class)->findAll();

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'offers' => $offers
        ]);
    }
}
