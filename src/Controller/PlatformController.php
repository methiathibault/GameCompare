<?php

namespace App\Controller;

use App\Entity\Platform;
use App\Form\PlatformFormType; 

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlatformController extends AbstractController
{
    #[Route('/plateforms', name: 'app_plateforms')]
    public function index(): Response
    {
        return $this->render('plateforms/index.html.twig', [
            'controller_name' => 'PlatformController',
        ]);
    }

    #[Route('/plateforms/create', name: 'app_plateforms_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {

        $plats = new Platform();

        $form = $this->createForm(PlatformFormType::class, $plats);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $plats = $form->getData();
            $em->persist($plats);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig', [
            'controller_name' => 'Add a plateform',
            'form' => $form,
        ]);

    }

    #[Route('/plateforms/delete/{id}', name: 'app_plateforms_delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $platform = $em->getRepository(Platform::class)->find($id);

        if(!$platform) {
            throw $this->createNotFoundException(
                'No platform found'
            );
        }

        $em->remove($platform);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/plateforms/update/{id}', name: 'app_plateforms_update')]
    public function updatePlat(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $platform = $em->getRepository(Platform::class)->find($id);

        if (!$platform) {
            throw $this->createNotFoundException(
                'No platform found' .$id
            );
        }

        $form = $this->createForm(PlatformFormType::class, $platform);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $platform = $form->getData($platform);
            $em->persist($platform);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig',[
            'controller_name' => 'GameController',
            'form' => $form,
        ]);
    } 
}
