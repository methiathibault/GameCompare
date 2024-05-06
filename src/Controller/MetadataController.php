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

class MetadataController extends AbstractController
{
    #[Route('/meta/create/dev', name: 'app_dev')]
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

        return $this->render('metadata/create.html.twig', [
            'controller_name' => 'Add a studio developpement',
            'form' => $form,
        ]);

    }

    #[Route('/meta/create/plat', name: 'app_dev_plat')]
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

        return $this->render('metadata/create.html.twig', [
            'controller_name' => 'Add a plateform',
            'form' => $form,
        ]);

    }

    #[Route('/meta/create/editor', name: 'app_dev_editor')]
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

        return $this->render('metadata/create.html.twig', [
            'controller_name' => 'Add a Game Editor',
            'form' => $form,
        ]);

    }

    #[Route('/meta/delete/plat/{id}', name: 'app_plat_delete')]
    public function deletePlat(EntityManagerInterface $em, int $id): Response
    {
        $platforms = $em->getRepository(NPlateforms::class)->find($id);

        if(!$platforms) {
            throw $this->createNotFoundException(
                'No platform found'
            );
        }

        $em->remove($platforms);
        $em->flush();

        return $this->redirectToRoute('app_game');
    }

    #[Route('/meta/delete/dev/{id}', name: 'app_dev_delete')]
    public function deleteDev(EntityManagerInterface $em, int $id): Response
    {
        $developer = $em->getRepository(Developers::class)->find($id);

        if(!$developer) {
            throw $this->createNotFoundException(
                'No platform found'
            );
        }

        $em->remove($developer);
        $em->flush();

        return $this->redirectToRoute('app_game');
    }

    #[Route('/meta/delete/editor/{id}', name: 'app_editor_delete')]
    public function deleteEditor(EntityManagerInterface $em, int $id): Response
    {
        $editor = $em->getRepository(NEditors::class)->find($id);

        if(!$editor) {
            throw $this->createNotFoundException(
                'No platform found'
            );
        }

        $em->remove($editor);
        $em->flush();

        return $this->redirectToRoute('app_game');
    }


    #[Route('game/update/{id}', name: 'app_game_update')]
    public function update(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $game = $em->getRepository(Game::class)->find($id);

        if (!$game) {
            throw $this->createNotFoundException(
                'No game found' .$id
            );
        }

        $form = $this->createForm(GameFormType::class, $game);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $game = $form->getData($game);
            $em->persist($game);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('game/create.html.twig',[
            'controller_name' => 'GameController',
            'form' => $form,
        ]);
    } 
}
