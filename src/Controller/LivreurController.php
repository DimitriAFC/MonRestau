<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur", name="livreur")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findBy(['status'=>"prete"]);
        return $this->render('livreur/index.html.twig', [
            
            'orders'=>$order,
        ]);
    }
}
