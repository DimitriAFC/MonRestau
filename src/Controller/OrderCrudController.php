<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\Order1Type;
use App\Repository\OrderRepository;
use App\Repository\OrderItemRepository;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/order/crud")
 */
class OrderCrudController extends AbstractController
{
    /**
     * @Route("/", name="order_crud_index", methods={"GET"})
     */
    public function index(OrderRepository $orderRepository,RestaurantRepository $restaurantRepository): Response
    {
        $user = $this->getUser();
        $restoid = $restaurantRepository->findBy(array('relation_user'=>$user)); 
        $resto = $orderRepository->findBy(['restaurant'=>$restoid]);
        return $this->render('order_crud/index.html.twig', [
            'orders' => $resto,
         
        ]);
    }
     /**
     * @Route("/enattente", name="order_attente", methods={"GET"})
     */
    public function enattente(OrderRepository $orderRepository,RestaurantRepository $restaurantRepository): Response
    {
        $user = $this->getUser();
        $restoid = $restaurantRepository->findBy(array('relation_user'=>$user)); 
        $resto = $orderRepository->findBy(['restaurant'=>$restoid,'status'=>"en attente"]);
        return $this->render('order_crud/index.html.twig', [
            'orders' => $resto,
         
        ]);
    }
      /**
     * @Route("/accepte", name="order_accepte", methods={"GET"})
     */
    public function accepte(OrderRepository $orderRepository,RestaurantRepository $restaurantRepository): Response
    {
        $user = $this->getUser();
        $restoid = $restaurantRepository->findBy(array('relation_user'=>$user)); 
        $resto = $orderRepository->findBy(['restaurant'=>$restoid,'status'=>"accepte"]);
        return $this->render('order_crud/index.html.twig', [
            'orders' => $resto,
         
        ]);
    }
        /**
     * @Route("/prete", name="order_prete", methods={"GET"})
     */
    public function prete(OrderRepository $orderRepository,RestaurantRepository $restaurantRepository): Response
    {
        $user = $this->getUser();
        $restoid = $restaurantRepository->findBy(array('relation_user'=>$user)); 
        $resto = $orderRepository->findBy(['restaurant'=>$restoid,'status'=>"prete"]);
        return $this->render('order_crud/index.html.twig', [
            'orders' => $resto,
         
        ]);
    }
       /**
     * @Route("/enLivraison", name="order_enlivraison", methods={"GET"})
     */
    public function enlivraison(OrderRepository $orderRepository,RestaurantRepository $restaurantRepository): Response
    {
        $user = $this->getUser();
        $restoid = $restaurantRepository->findBy(array('relation_user'=>$user)); 
        $resto = $orderRepository->findBy(['restaurant'=>$restoid,'status'=>"enLivraison"]);
        return $this->render('order_crud/index.html.twig', [
            'orders' => $resto,
         
        ]);
    }
       /**
     * @Route("/livre", name="order_livre", methods={"GET"})
     */
    public function livre(OrderRepository $orderRepository,RestaurantRepository $restaurantRepository): Response
    {
        $user = $this->getUser();
        $restoid = $restaurantRepository->findBy(array('relation_user'=>$user)); 
        $resto = $orderRepository->findBy(['restaurant'=>$restoid,'status'=>"valider"]);
        return $this->render('order_crud/index.html.twig', [
            'orders' => $resto,
         
        ]);
    }

    /**
     * @Route("/new", name="order_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $order = new Order();
        $form = $this->createForm(Order1Type::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('order_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_crud/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="order_crud_show", methods={"GET"})
     */
    public function show(Order $order,OrderItemRepository $orderItemRepository,$id): Response
    {
        $articles = $orderItemRepository->findBy(['orders'=>$id]);
        return $this->render('order_crud/show.html.twig', [
            'order' => $order,
            'articles'=>$articles,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Order1Type::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('order_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_crud/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="order_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_crud_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/update/", name="order_status_update")
     */
    public function updateStatus(Request $request, OrderRepository $orderRepository, OrderItemRepository $orderItemRepository): Response
    {
        $orderId = $request->get('orderId');
        $statusId = $request->get("statusId");

        $order = $orderRepository->findOneBy(['id'=>$orderId]);
        
        $order->setStatus($statusId);
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return $this->redirectToRoute("order_crud_index");
    }
}
