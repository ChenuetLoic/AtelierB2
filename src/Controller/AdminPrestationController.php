<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/prestation")
 */
class AdminPrestationController extends AbstractController
{
    /**
     * @Route("/", name="prestation_admin", methods={"GET"})
     * @param PrestationRepository $prestationRepository
     * @return Response
     */
    public function index(PrestationRepository $prestationRepository): Response
    {
        return $this->render('admin/prestation/index.html.twig', [
            'prestations' => $prestationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prestation_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirectToRoute('prestation_admin');
        }

        return $this->render('admin/prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prestation_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Prestation $prestation
     * @return Response
     */
    public function edit(Request $request, Prestation $prestation): Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestation_admin');
        }

        return $this->render('admin/prestation/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prestation_delete", methods={"DELETE"})
     * @param Request $request
     * @param Prestation $prestation
     * @return Response
     */
    public function delete(Request $request, Prestation $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prestation_admin');
    }
}
