<?php

namespace App\Controller;

use App\Entity\ZipCode;
use App\Form\ZipCodeType;
use App\Repository\ZipCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/zip/code")
 */
class ZipCodeController extends AbstractController
{
    /**
     * @Route("/", name="zip_code_index", methods={"GET"})
     */
    public function index(ZipCodeRepository $zipCodeRepository): Response
    {
        return $this->render('zip_code/index.html.twig', [
            'zip_codes' => $zipCodeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="zip_code_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zipCode = new ZipCode();
        $form = $this->createForm(ZipCodeType::class, $zipCode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zipCode);
            $entityManager->flush();

            return $this->redirectToRoute('zip_code_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('zip_code/new.html.twig', [
            'zip_code' => $zipCode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="zip_code_show", methods={"GET"})
     */
    public function show(ZipCode $zipCode): Response
    {
        return $this->render('zip_code/show.html.twig', [
            'zip_code' => $zipCode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="zip_code_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ZipCode $zipCode, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZipCodeType::class, $zipCode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('zip_code_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('zip_code/edit.html.twig', [
            'zip_code' => $zipCode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="zip_code_delete", methods={"POST"})
     */
    public function delete(Request $request, ZipCode $zipCode, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zipCode->getId(), $request->request->get('_token'))) {
            $entityManager->remove($zipCode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('zip_code_index', [], Response::HTTP_SEE_OTHER);
    }
}
