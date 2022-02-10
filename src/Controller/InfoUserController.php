<?php

namespace App\Controller;


use App\Entity\InfoUser;
use App\Form\InfosUsersType;
use App\Repository\InfoUserRepository;
use App\Repository\RestaurantTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoUserController extends AbstractController
{
    /**
     * @Route("/user", name="info_user")
     */
    public function new(Request $request, EntityManagerInterface $entityManager,RestaurantTypeRepository $restaurantTypeRepository): Response
    { 

        $user = $this->getUser();

        $InfoUser = new InfoUser();
        $form = $this->createForm(InfosUsersType::class, $InfoUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $InfoUser->setRelationUser($user);
            $entityManager->persist($InfoUser); 
            $entityManager->flush();
        }
        return $this->render('info_user/index.html.twig', [
            'form' => $form->createView(),
            'restaurant_types' => $restaurantTypeRepository->findAll(),
        ]);
}

/**
     * @Route("/informations", name="informations")
     */
    public function show(InfoUserRepository $infoUserRepository): Response
    { 
        $user = $this->getUser();
        $info = $infoUserRepository->findBy(array('relation_user'=>$user)); 
        return $this->render('info_user/informations.html.twig', [
            'info' => $info,
        ]);
    }

}