<?php

namespace App\Controller;

use App\Entity\RestaurantType;
use App\Form\RestaurantTypeType;
use App\Repository\RestaurantTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("type/restaurant")
 */
class RestaurantTypeController extends AbstractController
{
    /**
     * @Route("/", name="restaurant_type_index", methods={"GET"})
     */
    public function index(RestaurantTypeRepository $restaurantTypeRepository): Response
    {
        return $this->render('restaurant_type/index.html.twig', [
            'restaurant_types' => $restaurantTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="restaurant_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $restaurantType = new RestaurantType();
        $form = $this->createForm(RestaurantTypeType::class, $restaurantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($restaurantType);
            $entityManager->flush();

            return $this->redirectToRoute('restaurant_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurant_type/new.html.twig', [
            'restaurant_type' => $restaurantType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="restaurant_type_show", methods={"GET"})
     */
    public function show(RestaurantType $restaurantType): Response
    {
        return $this->render('restaurant_type/show.html.twig', [
            'restaurant_type' => $restaurantType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="restaurant_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, RestaurantType $restaurantType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RestaurantTypeType::class, $restaurantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('restaurant_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurant_type/edit.html.twig', [
            'restaurant_type' => $restaurantType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="restaurant_type_delete", methods={"POST"})
     */
    public function delete(Request $request, RestaurantType $restaurantType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurantType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($restaurantType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('restaurant_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
