<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 class CartController extends AbstractController
 {
    public function totalpanier(CartRepository $cartRepository){
        $panier = $cartRepository->findAll();
        $totalpanier=0;
        foreach($panier as $panieritem){
            $totalpanier = $totalpanier + ($panieritem->getQuantity() * $panieritem->getProduct()->getPrice());
        }
        return $totalpanier;
    }
    /**
     * @Route("/panier", name="panier")
     */

    public function index(CategoryRepository $CategoryRepository,CartRepository $cartRepository): Response
    {
        $user = $this->getUser();
        $total = 0;
        $panier = $cartRepository->findBy(array('user'=>$user));
        foreach($panier as $panieritem){
            $total = $total + ($panieritem->getQuantity() * $panieritem->getProduct()->getPrice());
        }
        
       
        return $this->render('panier/index.html.twig', [
        'categories'=>$CategoryRepository->findAll(),
        'panier'=>$cartRepository->findBy(array('user'=>$user)),
        'total'=> $total,
        ]);
    }

    /**
     * @Route("/add/{id}" , name="panier_add")
     */
    public function add(CartRepository $cartRepository,int $id, ProductRepository $productRepository)
    {
     
        $user = $this->getUser();
       
        $panier = $cartRepository->findOneBy(array('product'=> $id ,'user'=>$user));
        $article= $productRepository->find($id);
   
            $quantity=1;
        
        
        if($panier){
            $panierquantity = $panier->getQuantity();
            $panierquantity = $panierquantity + $quantity;
            $panier->setQuantity($panierquantity);
            
        }else{
            
            $panier = new Cart();
            $panier->setQuantity($quantity);
         //   $panier->setUser($user);
            $panier->setProduct($article);
            
        }
       
 
        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('panier');
    }
    /**
     * @Route("/remove/{id}" , name="panier_suppression")
     */
    public function remove(CartRepository $cartRepository,int $id)
    {
        $user = $this->getUser();
 
        $panier = $cartRepository->findOneBy(array('article'=>$id ,'user'=>$user));
      
        $panierquantite = $panier->getQuantity();
       
        $entityManager = $this->getDoctrine()->getManager();
        if($panierquantite < 1){
            $entityManager->remove($panier);
        }else{
            $panierquantite--;
            $panier->setQuantity($panierquantite);
            $entityManager->persist($panier);
        }
        
            $entityManager->flush();
            return $this->redirectToRoute('panier');
    }

     /**
     * @Route("/suppression_article/{id}" , name="suppression_article")
     */
    public function suppressionProduit(CartRepository $cartRepository,int $id)
    {
        $user=$this->getUser();
        $panier = $cartRepository->findOneBy(array('article'=>$id,'user'=>$user));
        $entityManager= $this->getDoctrine()->getManager();
        $entityManager->remove($panier);
        $entityManager->flush();
      
        return $this->redirectToRoute('panier');
    }
     /**
     * @Route("/suppression" , name="suppression")
     */
    public function removepanier(CartRepository $cartRepository)
    {
        
        $user = $this->getUser();
        $panier = $cartRepository->findBy(array('user'=> $user));
        $entityManager= $this->getDoctrine()->getManager();
        foreach($panier as $panieritem){
            $entityManager->remove($panieritem); 
        }
        
        $entityManager->flush();

        return $this->redirectToRoute('panier');
    }
}
