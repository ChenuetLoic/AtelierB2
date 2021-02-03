<?php

namespace App\Controller;

use App\Entity\PicturesProjet;
use App\Form\PicturesProjetType;
use App\Repository\PicturesProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class PicturesProjetController extends AbstractController
{
    /**
     * @Route("/images-projet", name="pictures_index", methods={"GET"})
     * @param PicturesProjetRepository $picturesProjetRepository
     * @return Response
     */
    public function index(PicturesProjetRepository $picturesProjetRepository): Response
    {
        return $this->render('admin/pictures_projet/index.html.twig', [
            'pictures_projets' => $picturesProjetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="pictures_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $picturesProjet = new PicturesProjet();
        $form = $this->createForm(PicturesProjetType::class, $picturesProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picturesProjet);
            $entityManager->flush();

            return $this->redirectToRoute('pictures_index');
        }

        return $this->render('admin/pictures_projet/new.html.twig', [
            'pictures_projet' => $picturesProjet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pictures_show", methods={"GET"})
     * @param PicturesProjet $picturesProjet
     * @return Response
     */
    public function show(PicturesProjet $picturesProjet): Response
    {
        return $this->render('admin/pictures_projet/show.html.twig', [
            'pictures_projet' => $picturesProjet,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="pictures_edit", methods={"GET","POST"})
     * @param Request $request
     * @param PicturesProjet $picturesProjet
     * @return Response
     */
    public function edit(Request $request, PicturesProjet $picturesProjet): Response
    {
        $form = $this->createForm(PicturesProjetType::class, $picturesProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pictures_index');
        }

        return $this->render('admin/pictures_projet/edit.html.twig', [
            'pictures_projet' => $picturesProjet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pictures_projet_delete", methods={"DELETE"})
     * @param Request $request
     * @param PicturesProjet $picturesProjet
     * @return Response
     */
    public function delete(Request $request, PicturesProjet $picturesProjet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picturesProjet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picturesProjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pictures_index');
    }
}
