<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Form\ProjetsType;
use App\Repository\ProjetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ProjetsController extends AbstractController
{
    /**
     * @Route("/projets", name="projets_index", methods={"GET"})
     * @param ProjetsRepository $projetsRepository
     * @return Response
     */
    public function index(ProjetsRepository $projetsRepository): Response
    {
        return $this->render('admin/projets/index.html.twig', [
            'projets' => $projetsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="projets_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('projets_index');
        }

        return $this->render('admin/projets/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projets_show", methods={"GET"})
     * @param Projets $projet
     * @return Response
     */
    public function show(Projets $projet): Response
    {
        return $this->render('admin/projets/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="projets_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Projets $projet
     * @return Response
     */
    public function edit(Request $request, Projets $projet): Response
    {
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projets_index');
        }

        return $this->render('admin/projets/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projets_delete", methods={"DELETE"})
     * @param Request $request
     * @param Projets $projet
     * @return Response
     */
    public function delete(Request $request, Projets $projet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projets_index');
    }
}
