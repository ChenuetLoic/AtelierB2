<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Repository\CarouselRepository;
use App\Repository\PictureRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param CarouselRepository $carouselRepository
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(
        CarouselRepository $carouselRepository,
        ProjectRepository $projectRepository
    ): Response {
        return $this->render('home/index.html.twig', [
            'pictures' => $carouselRepository->findAll(),
            'projets' => $projectRepository->findAll(),
        ]);
    }
}
