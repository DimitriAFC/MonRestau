<?php

namespace App\Controller;


use App\Entity\InfoUser;
use App\Form\InfosUsersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoUserController extends AbstractController
{
    /**
     * @Route("/info/user", name="info_user")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    { 
        $InfoUser = new InfoUser();
        $form = $this->createForm(InfosUsersType::class, $InfoUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($InfoUser);
            $entityManager->flush();
            // return $this->redirectToRoute('in');
        }
        return $this->render('info_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
}

}

