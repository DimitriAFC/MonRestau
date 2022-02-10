<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryCustomerController extends AbstractController
{
    /**
     * @Route("/delivery/customer", name="delivery_customer")
     */
    public function index(): Response
    {
        return $this->render('delivery_customer/index.html.twig', [
            'controller_name' => 'DeliveryCustomerController',
        ]);
    }
}
