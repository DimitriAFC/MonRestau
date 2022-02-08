<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(RestaurantRepository $restaurantRepository): Response
    {
       
        return $this->render('main/index.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
            
        ]);
    }
    
    /**
     * @Route("/produitrestaurant/{id}", name="produitrestaurant")
     */
    public function show(RestaurantRepository $restaurantRepository,ProductRepository $product,$id): Response
    {
        return $this->render('main/produitrestaurant.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
            'products'=>$product->findBy(['relation_restaurant'=> $id]),
        ]);
    }
}
