<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\OrderItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/livreur")
     */
class LivreurController extends AbstractController
{
    /**
     * @Route("/commande", name="livreur")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findBy(['status'=>"prete"]);
        return $this->render('livreur/index.html.twig', [
            
            'orders'=>$order,
        ]);
    }
    /**
     * @Route("/{id}", name="livreur_show", methods={"GET"})
     */
    public function show(Order $order,OrderItemRepository $orderItemRepository,$id): Response
    {
        $articles = $orderItemRepository->findBy(['orders'=>$id]);

        return $this->render('livreur/show.html.twig', [
            'order' => $order,
            'articles'=>$articles,
        ]);
    }
     /**
     * @Route("/update/", name="livreur_status_update")
     */
    public function updateStatus(Request $request, OrderRepository $orderRepository): Response
    {
        $orderId = $request->get('orderId');
        $statusId = $request->get("statusId");
        $user = $this->getUser();
        $order = $orderRepository->findOneBy(['id'=>$orderId]);
        
        $order->setStatus($statusId);
        $order->setLivreur($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return $this->redirectToRoute("livreur");
    }
    /**
     * @Route("/commande/valider", name="livreur_Valide")
     */
    public function Check(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findBy(['status'=>"enLivraison"]);
        return $this->render('livreur/valide.html.twig', [
            
            'orders'=>$order,
        ]);
    }
        /**
     * @Route("/{id}/valide", name="livreur_show_valide", methods={"GET"})
     */
    public function showValide(Order $order,OrderItemRepository $orderItemRepository,$id): Response
    {
        $articles = $orderItemRepository->findBy(['orders'=>$id]);
        return $this->render('livreur/show_valide.html.twig', [
            'order' => $order,
            'articles'=>$articles,
        ]);
    }
}
