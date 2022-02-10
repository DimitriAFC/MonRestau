<?php

namespace App\Controller;
use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\OrderItem;
use App\Repository\CartRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class OrderController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/order", name="order")
     */
    public function index(Request $request,CartRepository $cartRepository): Response
    {
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);
        $user = $this->getUser();
        $cart = $cartRepository->findBy(array('user'=>$user->getId()));
        $shipping = "3";
        $total = 0;
    
        foreach($cart as $cartitem){
            $total = $total + ($cartitem->getQuantity() * $cartitem->getProduct()->getPrice());
        
        }
        return $this->render('order/index.html.twig', [
            'form'=>$form->createView(),
            'cart'=>$cart,
            'total'=> $total,
            'shipping'=>$shipping,
            
        ]);
    }
    /**
     * @Route("/commande/recupilatif", name="order_recap" )
     */
    public function add(CartRepository $cartRepository,Request $request,OrderRepository $orderRepository,OrderItemRepository $OrderItemRepository, ProductRepository $productRepository): Response
    {
        $user = $this->getUser();
        $cart = $cartRepository->findBy(array('user'=>$user->getId()));
        $form = $this->createForm(OrderType::class);
        $total=0;
        $shipping = "3";
   
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()){
         
            $date=new DateTime();
            $adress = $form->get('adress')->getData();
            $zipcode = $form->get('zipcode')->getData();
            $city = $form->get('city')->getData();
            $lastname = $form->get('LastName')->getData();
            $firsttname = $form->get('firstName')->getData();
            $time = $form->get('time')->getData();
            $number = $form->get('number')->getData();

            $order=new Order();
            $order->setUser($user);
            $order->setDate($date);
            $order->setFirstname($firsttname);
            $order->setLastName($lastname);
            $order->setAdress($adress);
            $order->setZipcode($zipcode);
            $order->setCity($city);
            $order->setNumber($number);
          //  $order->setEmail($user->getEmail());
            $order->setStatus("en attente");
           
           $order->setTime($time);

            $this->entityManager->persist($order);
            
            foreach ($cart as $cartitem ){
                $orderItem = new OrderItem();
                $cartPrice = $cartitem->getProduct()->getPrice();
                $cartProduct =  $cartitem->getProduct();
                $cartQuantity = $cartitem->getQuantity();
                $cartTotal = $cartitem->getProduct()->getPrice()* $cartitem->getQuantity();
            
                $orderItem->setPriceUnit($cartPrice);
                $orderItem->setProduct($cartProduct);
                $orderItem->setQuantity($cartQuantity);
                $orderItem->setOrders($order);
                $orderItem->setTotal($cartTotal);
                $this->entityManager->persist($orderItem);
                $resto = $cartitem->getRestaurant();
                $total = $total + ($cartitem->getQuantity() * $cartitem->getProduct()->getPrice());
                $order->setRestaurant($resto);

            }
         
            //$order->setRestaurant($resto);
            $shipping = "3";
            $order->setTotal($total);
            $order->setShipping($shipping);

            $this->entityManager->persist($order);
            $this->entityManager->flush();
            
    }

    $cart = $cartRepository->findBy(array('user'=>$this->getUser()->getId()));
    foreach ($cart as $cartitem){
        $product = $productRepository->findOneBy(array('id'=>$cartitem->getProduct()->getId()));
        $product->setStock($product->getStock() - $cartitem->getQuantity());
    }
    $this->entityManager->flush();
    $this->entityManager->persist($product);

    foreach($cart as $cartitem){
        $this->entityManager->remove($cartitem); 
    }
    
    $this->entityManager->flush();
    $cart=null;
    $articles = $OrderItemRepository->findBy(['orders'=>$order->getId()]);
    return $this->render('order/valide.html.twig', [

        'cart'=>$cart,
        'order'=>$order,
        'articles'=>$articles,
        'shipping'=>$shipping,
    ]);
    }
   
}
