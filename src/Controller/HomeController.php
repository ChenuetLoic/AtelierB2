<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
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
     * @return Response
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'pictures' => $carouselRepository->findAll()
        ]);
    }
}
