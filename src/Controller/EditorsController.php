<?php

namespace App\Controller;

use App\Entity\NEditors;
use App\Form\EditorsFormType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditorsController extends AbstractController
{
    #[Route('/editors', name: 'app_editors')]
    public function index(): Response
    {
        return $this->render('editors/index.html.twig', [
            'controller_name' => 'EditorsController',
        ]);
    }

    #[Route('/editors/create', name: 'app_editors_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
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

        return $this->render('create.html.twig', [
            'controller_name' => 'Add a Game Editor',
            'form' => $form,
        ]);

    }

    #[Route('/editors/delete/{id}', name: 'app_editors_delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
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

}