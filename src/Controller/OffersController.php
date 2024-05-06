<?php

namespace App\Controller;

use App\Entity\Offers;
use App\Form\OfferFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class OffersController extends AbstractController
{
    #[Route('/offers', name: 'offers')]
    public function index(EntityManagerInterface $em): Response
    {

        $myoffers = $em -> getRepository(Offers::class)-> findAll();

        //dd($myoffers);

        return $this->render('offers/index.html.twig', [
            'controller_name' => 'OffersController',
            'offers' => $myoffers,
        ]);
    }


    #[Route('/offers/delete/{id}', name: 'offers_delete')]
    public function delete(EntityManagerInterface $em,int $id): Response
    {
        
        $offerToDelete = $em -> getRepository(offers::class)-> find($id);
        
        if (!$offerToDelete) {
            throw $this->createNotFoundException(
                'No offer found'
            );
        }
        
        $em->remove($offerToDelete);
        $em->flush();

        return $this->redirectToRoute('offers');
    }

    #[Route('/offers/deleteall', name: 'offers_delete_all')]
    public function deleteAll(EntityManagerInterface $em): Response
    {
        
        $allOffers = $em -> getRepository(offers::class)-> findAll();
        
        if (!$allOffers) {
            throw $this->createNotFoundException(
                'No offer found'
            );
        }

        foreach ($allOffers as $offer){
            $em->remove($offer);
            $em->flush();
        }
        

        return $this->redirectToRoute('offers');
    }

    #[Route('/offers/create', name: 'offers_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {

        $newOffer = new Offers();
        
        $form =   $this->createForm(OfferFormType::class, $newOffer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $offer= $form->getData();
            $em->persist($offer);
            $em->flush();
            return $this->redirectToRoute('offers');

        }

        return $this->render('offers/create.html.twig', [
            'controller_name' => 'OffersController',
            'form' => $form,
        ]);

        return $this->redirectToRoute('offers');
    }
}
