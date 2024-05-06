<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $em): Response
    {
        $games = $em->getRepository(Game::class)->findAll();
        $offers = $em->getRepository(Offers::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'games' => $games,
            'offers' => $offers,
        ]);
    }
}
