<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RestaurantTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarController extends AbstractController
{
    /**
     * @Route("/nav/bar", name="nav_bar")
     */
    public function index(RestaurantTypeRepository $restaurantTypeRepository): Response
    {
        $userRole = $this->getUser()->getRoles();
        return $this->render('nav_bar/index.html.twig', [
            'controller_name' => 'NavBarController',
            'restaurant_types' => $restaurantTypeRepository->findAll(),
            'userRole' => $userRole,
        ]);
    }
}
