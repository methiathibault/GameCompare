<?php

namespace App\Controller;

use App\Entity\Developers;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\DevFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/create/dev', name: 'app_admin')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {

        $devs = new Developers();

        $form = $this->createForm(DevFormType::class, $devs);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $devs = $form->getData();
            $em->persist($devs);
            $em->flush();
            return $this->redirectToRoute('app_game');
        }

        return $this->render('admin/create.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form,
        ]);

    }
}
