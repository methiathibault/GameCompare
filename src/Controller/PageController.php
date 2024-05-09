<?php

namespace App\Controller;

use App\Entity\Offers;
use App\Entity\Game;
use App\Entity\Platform;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(EntityManagerInterface $em): Response
    {
        $offers = $em->getRepository(Offers::class)->findAll();

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'offers' => $offers
        ]);
    }

    #[Route('/page/platforms', name: 'app_page_all_platforms')]
    public function allplatform(EntityManagerInterface $em): Response
    {
        $games = $em->getRepository(Game::class)->findAll();
        $platforms = $em->getRepository(Platform::class)->findAll();

        $platformType = [];
        foreach($platforms as $platform){
            array_push($platformType,$platform->getName());
        }

        return $this->render('page/filterPage.html.twig', [
            'games' => $games,
            'platforms' => $platformType,
            'choice' => "every platforms",
        ]);
    }


    #[Route('/page/platforms/{platformPost}', name: 'app_page_post_platforms')]
    public function platformPost(EntityManagerInterface $em,string $platformPost): Response
    {

        if($platformPost == "all"){
            return $this->redirectToRoute('app_page_all_platforms');
        }

        $platforms = $em->getRepository(Platform::class)->findAll();

        $platformType = ["all"];
        foreach($platforms as $platform){
            array_push($platformType,$platform->getName());
        }

        if(!in_array($platformPost,$platformType)){
            throw $this->createNotFoundException(
                'No platform found ' .$platformPost
            );
        }

        $games = $em->getRepository(Game::class)->findAll();

        $platformGame = [];

        foreach($games as $game ){
            $platforms = $game -> getPlatforms();
            foreach($platforms as $platform){
                if($platform ->getName() == $platformPost){
                    array_push($platformGame, $game);
                }
            }
        }

        return $this->render('page/filterPage.html.twig', [
            'games' => $platformGame,
            'platforms' => $platformType,
            'choice' => $platformPost,
        ]);
    }


}
