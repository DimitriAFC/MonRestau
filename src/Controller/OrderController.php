<?php

namespace App\Controller;
use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\OrderItem;
use App\Repository\CartRepository;
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
 
        $total = 0;
    
        foreach($cart as $cartitem){
            $total = $total + ($cartitem->getQuantity() * $cartitem->getProduct()->getPrice());
        
        }
        return $this->render('order/index.html.twig', [
            'form'=>$form->createView(),
            'cart'=>$cart,
            'total'=> $total,
            
        ]);
    }
    /**
     * @Route("/commande/recupilatif", name="order_recap" )
     */
    public function add(CartRepository $cartRepository,Request $request): Response
    {
        $user = $this->getUser();
        
        $cart = $cartRepository->findBy(array('user'=>$user->getId()));

     
        $form = $this->createForm(OrderType::class);

        $total=0;

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()){
         
            $date=new DateTime();
            $adress = $form->get('adress')->getData();
            $zipcode = $form->get('zipcode')->getData();
            $city = $form->get('city')->getData();
            $delivery = $form->get('adress')->getData();
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
            $order->setStatus("commande validé");
           
           $order->setTime($time);

            $this->entityManager->persist($order);
            
             $totalWeight =0 ;
       
   
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
            
            }
            foreach($cart as $cartitem){
                $total = $total + ($cartitem->getQuantity() * $cartitem->getProduct()->getPrice());
                
                }
               
                $order->setRestaurant($resto);
            $shipping = "3";
            $order->setTotal($total);
            $order->setShipping($shipping);
            $this->entityManager->persist($order);
            
            $this->entityManager->flush();
            

        return $this->render('order/valide.html.twig', [
           
        ]);
    }
    }
}
