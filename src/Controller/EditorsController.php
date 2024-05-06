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
            return $this->redirectToRoute('app_admin');
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
                'No editor found'
            );
        }

        $em->remove($editor);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/editors/update/{id}', name: 'app_editors_update')]
    public function updateEdit(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $editor = $em->getRepository(NEditors::class)->find($id);

        if (!$editor) {
            throw $this->createNotFoundException(
                'No editor found' .$id
            );
        }

        $form = $this->createForm(EditorsFormType::class, $editor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $editor = $form->getData($editor);
            $em->persist($editor);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('create.html.twig',[
            'controller_name' => 'GameController',
            'form' => $form,
        ]);
    } 

}
