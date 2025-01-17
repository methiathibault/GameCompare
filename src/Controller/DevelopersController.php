<?php

namespace App\Controller;

use App\Entity\Developers;
use App\Form\DevFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/developers/create', name: 'app_developers_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $developer = new Developers();

        $form = $this->createForm(DevFormType::class, $developer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $developer = $form->getData();
            $em->persist($developer);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig', [
            'controller_name' => 'Developers',
            'form' => $form,
        ]);
    }

    #[Route('/developers/delete/{id}', name: 'app_developers_delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $developer = $em->getRepository(Developers::class)->find($id);

        if(!$developer) {
            throw $this->createNotFoundException(
                'No game found' .$id
            );
        }

        $em->remove($developer);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route('developers/update/{id}', name: 'app_developers_update')]
    public function update(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $developer = $em->getRepository(Developers::class)->find($id);

        if (!$developer) {
            throw $this->createNotFoundException(
                'No developer found' .$id
            );
        }

        $form = $this->createForm(DevFormType::class, $developer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $developer = $form->getData($developer);
            $em->persist($developer);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig',[
            'controller_name' => 'Developers',
            'form' => $form,
        ]);
    }

    #[Route('/developers/update/{id}', name: 'app_developers_update')]
    public function updateDev(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $dev = $em->getRepository(Developers::class)->find($id);

        if (!$dev) {
            throw $this->createNotFoundException(
                'No game found' .$id
            );
        }

        $form = $this->createForm(DevFormType::class, $dev);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $dev = $form->getData($dev);
            $em->persist($dev);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig',[
            'controller_name' => 'GameController',
            'form' => $form,
        ]);
    } 
}
