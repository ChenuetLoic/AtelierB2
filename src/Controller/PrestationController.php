<?php

namespace App\Controller;


use App\Repository\CarouselRepository;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prestation")
 */
class PrestationController extends AbstractController
{
    /**
     * @Route("/", name="prestation_index")
     * @param PrestationRepository $prestationRepository
     * @param CarouselRepository $carouselRepository
     * @return Response
     */
    public function index(PrestationRepository $prestationRepository, CarouselRepository $carouselRepository): Response
    {
        return $this->render('prestation/index.html.twig', [
            'pictures' => $carouselRepository->findAll(),
            'prestations'=> $prestationRepository->findAll()
        ]);
    }
}
