<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RestaurantTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarController extends AbstractController
{
    public function index(RestaurantTypeRepository $restaurantTypeRepository): Response
    {
        return $this->render('nav_bar/index.html.twig', [
            'controller_name' => 'NavBarController',
            'restaurant_types' => $restaurantTypeRepository->findAll(),
        ]);
    }
}
