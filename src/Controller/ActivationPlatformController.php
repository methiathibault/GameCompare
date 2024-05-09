<?php

namespace App\Controller;

use App\Entity\ActivationPlatform;
use App\Form\ActivationPlatformFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivationPlatformController extends AbstractController
{
    #[Route('/activation/platform', name: 'app_activation_platform')]
    public function index(): Response
    {
        return $this->render('activation_platform/index.html.twig', [
            'controller_name' => 'ActivationPlatformController',
        ]);
    }

    #[Route('/activation/platform/create', name: 'app_activation_platform_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {

        $activationPlatform = new ActivationPlatform();

        $form = $this->createForm(ActivationPlatformFormType::class, $activationPlatform);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $activationPlatform = $form->getData();
            $em->persist($activationPlatform);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig', [
            'controller_name' => 'Add an activation plateform',
            'form' => $form,
        ]);
    }

    #[Route('activation/platform/delete/{id}', name: 'app_activation_platform_delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $activationPlatform = $em->getRepository(ActivationPlatform::class)->find($id);

        if(!$activationPlatform){
            $this->createNotFoundException(
                'No activation activationPlatform found' .$id
            );
        }

        $em->remove($activationPlatform);
        $em->flush();
        return $this->redirectToRoute('app_admin');
    }

    #[Route('activation/platform/update/{id}', name: 'app_activation_platforms_update')]
    public function updatePlat(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $activationPlatform = $em->getRepository(ActivationPlatform::class)->find($id);

        if (!$activationPlatform) {
            throw $this->createNotFoundException(
                'No platform found' .$id
            );
        }

        $form = $this->createForm(ActivationPlatformFormType::class, $activationPlatform);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $activationPlatform = $form->getData($activationPlatform);
            $em->persist($activationPlatform);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig',[
            'controller_name' => 'ActivationPlatform',
            'form' => $form,
        ]);
    } 
}
