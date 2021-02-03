<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\PictureRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/projets")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="projets_index", methods={"GET"})
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('admin/projets/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="projets_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $projet = new Project();
        $form = $this->createForm(ProjectType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash('success', 'Le projet à bien été ajoutée');

            return $this->redirectToRoute('projets_index');
        }

        return $this->render('admin/projets/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="projets_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Project $projet
     * @return Response
     */
    public function edit(Request $request, Project $projet): Response
    {
        $form = $this->createForm(ProjectType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le projet à bien été modifiée');

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
     * @param Project $projet
     * @return Response
     */
    public function delete(Request $request, Project $projet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
            $this->addFlash('danger', 'Le projet à bien été supprimée');
        }

        return $this->redirectToRoute('projets_index');
    }
}
