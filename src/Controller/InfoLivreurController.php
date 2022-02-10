<?php

namespace App\Controller;

use App\Entity\InfoUser;
use App\Entity\Vehicle;
use App\Form\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class InfoLivreurController extends AbstractController
{
    /**
     * @Route("/livreur/informations", name="info_livreur")
     */
    public function index(): Response
    {
        return $this->render('info_livreur/index.html.twig', [
            'controller_name' => 'InfoLivreurController',
        ]);
    }

      /**
     * @Route("/livreur/vehicle", name="info_vehicle")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    { 

        $user = $this->getUser()->getId();      

        $Vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $Vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Vehicle->setLivreur($user);
            $entityManager->persist($Vehicle); 
            $entityManager->flush();
        }
        return $this->render('info_livreur/index.html.twig', [
            'form' => $form->createView(),
        ]);
}
    
}
