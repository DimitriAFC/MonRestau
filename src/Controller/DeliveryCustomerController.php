<?php

namespace App\Controller;
use App\Form\DeliveryType;
use App\Entity\Delivery;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CartRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryCustomerController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(CartRepository $cartRepository): Response
    {
    $user = $this->getUser();
    $total = 0;
   $cart = $cartRepository->findBy(array('user'=>$user->getId()));
   $delivery = new Delivery;
    $form = $this->createForm(DeliveryType::class,$delivery);
 

    foreach($cart as $cartitem){
       $total = $total + ($cartitem->getQuantity() * $cartitem->getProduct()->getPrice());
        
    }
        return $this->render('delivery_customer/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}

