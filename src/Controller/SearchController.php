<?php

namespace App\Controller;

use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    
                    'placeholder' => '',
                    
                ]
            ])
            ->add('recherche', SubmitType::class, [
                
                'attr'=>[
                    'class'=>'bi bi-search',
                ]
                
               
            ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }
       /**
     * @Route("/handleSearch", name="handleSearch")
     * @param Request $request
     */
    public function handleSearch(Request $request, ProductRepository $repo,RestaurantRepository $restaurantRepository,CartRepository $cartRepository)
    {
        if($this->getUser()){
            $user = $this->getUser();
            $cart = $cartRepository->findBy(array('user'=>$user->getId()));
            }else{
                $cart=null;
            }
        $query = $request->request->get('form')['query'];
        if($query) {
            $productSearch = $repo->findProductSearchByName($query);
            $restaurant = $restaurantRepository->findRestaurantSearch($query);
        }
        return $this->render('search/index.html.twig', [
            'productSearch' => $productSearch,
            'restaurantSearch'=>$restaurant,
            'query'=>$query,
            'cart'=>$cart,
        ]);
    }
}
