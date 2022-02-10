<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use App\Repository\OrderItemRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
  /**
     * @Route("/profile/order", name="myorder")
     */
    public function index(OrderItemRepository $orderItemRepository,OrderRepository $orderRepository,CartRepository $cartRepository): Response
    {
        $user = $this->getUser();
        $orders=$orderRepository->findBy(array('user'=>$user->getId()));
        $articles = $orderItemRepository->findBy(['orders'=>$orders]);
        
        return $this->render('profile/index.html.twig', [
            'orders'=>$orders,
            'articles'=>$articles,
            'cart'=>$cartRepository->findBy(array('user'=>$user->getId())),
        ]);
    }
      /**
     * @Route("/profile/order/show/{id}", name="profile_order_show", methods={"GET"})
     */
    public function show(int $id,Order $order, OrderItemRepository $orderItemRepository,OrderRepository $orderRepository,CartRepository $cartRepository): Response
    {
        $user = $this->getUser();
        $articles = $orderItemRepository->findBy(['orders'=>$id]);
        return $this->render('profile/show.html.twig', [
            'order' => $order,
            'articles'=>$articles,
            
            'cart'=>$cartRepository->findBy(array('user'=>$user->getId())),
        ]);
}
}
