<?php

namespace App\Controller;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/about")
 */
class AdminAboutController extends AbstractController
{
    /**
     * @Route("/", name="about_admin", methods={"GET"})
     * @param AboutRepository $aboutRepository
     * @return Response
     */
    public function index(AboutRepository $aboutRepository): Response
    {
        return $this->render('admin/about/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="about_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $about = new About();
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($about);
            $entityManager->flush();

            return $this->redirectToRoute('about_admin');
        }

        return $this->render('admin/about/new.html.twig', [
            'about' => $about,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="about_show", methods={"GET"})
     * @param About $about
     * @return Response
     */
    public function show(About $about): Response
    {
        return $this->render('admin/about/show.html.twig', [
            'about' => $about,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="about_edit", methods={"GET","POST"})
     * @param Request $request
     * @param About $about
     * @return Response
     */
    public function edit(Request $request, About $about): Response
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_admin');
        }

        return $this->render('admin/about/edit.html.twig', [
            'about' => $about,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="about_delete", methods={"DELETE"})
     * @param Request $request
     * @param About $about
     * @return Response
     */
    public function delete(Request $request, About $about): Response
    {
        if ($this->isCsrfTokenValid('delete'.$about->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($about);
            $entityManager->flush();
        }

        return $this->redirectToRoute('about_admin');
    }
}
