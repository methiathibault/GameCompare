<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(EntityManagerInterface $em): Response
    {
        $games = $em->getRepository(Game::class)->findAll();

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'games' => $games
        ]);
    }

    #[Route('/game/delete/{id}', name: 'app_game_delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $game = $em->getRepository(Game::class)->find($id);

        if(!$game) {
            throw $this->createNotFoundException(
                'No game found' .$id
            );
        }

        $em->remove($game);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route('game/deleteall', name: 'app_game_deleteall')]
    public function deleteAll(EntityManagerInterface $em): Response
    {
        $games = $em->getRepository(Game::class)->findAll();

        if(!$games) {
            throw $this->createNotFoundException(
                'No games found'
            );
        }

        foreach ($games as $game) {
            $em->remove($game);
            $em->flush();  
        }

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/game/create', name: 'app_game_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $game = new Game();

        $form = $this->createForm(GameFormType::class, $game);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $game = $form->getData();
            $em->persist($game);
            $em->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('game/create.html.twig', [
            'controller_name' => 'GameController',
            'form' => $form,
        ]);
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
