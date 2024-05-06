<?php

namespace App\Controller;

use App\Entity\Developers;
use App\Entity\NPlateforms;
use App\Entity\NEditors;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\DevFormType;
use App\Form\PlateformsFormType;
use App\Form\EditorsFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DevController extends AbstractController
{
    #[Route('/dev/create/dev', name: 'app_dev')]
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

        return $this->render('dev/create.html.twig', [
            'controller_name' => 'Add a studio developpement',
            'form' => $form,
        ]);

    }

    #[Route('/dev/create/plat', name: 'app_dev_plat')]
    public function createPlateform(EntityManagerInterface $em, Request $request): Response
    {

        $plats = new NPlateforms();

        $form = $this->createForm(PlateformsFormType::class, $plats);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $plats = $form->getData();
            $em->persist($plats);
            $em->flush();
            return $this->redirectToRoute('app_game');
        }

        return $this->render('dev/create.html.twig', [
            'controller_name' => 'Add a plateform',
            'form' => $form,
        ]);

    }

    #[Route('/dev/create/editor', name: 'app_dev_editor')]
    public function createEditor(EntityManagerInterface $em, Request $request): Response
    {

        $editors = new NEditors();

        $form = $this->createForm(EditorsFormType::class, $editors);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $editors = $form->getData();
            $em->persist($editors);
            $em->flush();
            return $this->redirectToRoute('app_game');
        }

        return $this->render('dev/create.html.twig', [
            'controller_name' => 'Add a Game Editor',
            'form' => $form,
        ]);

    }
}
