<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\RestaurantRepository;
use App\Repository\RestaurantTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(RestaurantRepository $restaurantRepository,RestaurantTypeRepository $restaurantTypeRepository): Response
    {
        $restaurantC = $restaurantRepository->findBy(['relation_type'=>3]);
        $restaurantFF= $restaurantRepository->findBy(['relation_type'=>1]);
        $restaurantP= $restaurantRepository->findBy(['relation_type'=>2]);
       
        return $this->render('main/index.html.twig', [
            //'restaurants' => $restaurantRepository->findAll(),
            'restaurantC'=>$restaurantC,
            'restaurantFF'=>$restaurantFF,
            'restaurantP'=>$restaurantP,
            'restaurant_types' => $restaurantTypeRepository->findAll(),
        ]);
    }
       /**
     * @Route("/produitrestaurant/{id}", name="produitrestaurant")
     */
    public function show(RestaurantRepository $restaurantRepository,ProductRepository $product,$id,RestaurantTypeRepository $restaurantTypeRepository): Response
    {
        return $this->render('main/listeproduit.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
            'products'=>$product->findBy(['relation_restaurant'=> $id]),
            'restaurant_types' => $restaurantTypeRepository->findAll(),
        ]);
    }
           /**
     * @Route("/fiche/{id}", name="produit_id")
     */
    public function fiche($id,ProductRepository $productRepository)
    {
      
        return $this->render('main/produit.html.twig', [
            'product'=> $productRepository->find($id),
        ]);
    }
}
