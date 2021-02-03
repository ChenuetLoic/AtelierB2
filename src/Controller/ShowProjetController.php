<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/projet")
 */
class ShowProjetController extends AbstractController
{
    /**
     * @Route("/{id}", name="picture_show", methods={"GET"})
     * @param ProjectRepository $projectRepository
     * @param PictureRepository $pictureRepository
     * @param int $id
     * @return Response
     */
    public function show(ProjectRepository $projectRepository, PictureRepository $pictureRepository, int $id): Response
    {
        return $this->render('/picture/show.html.twig', [
            'projects' => $projectRepository->find($id),
            'pictures' => $pictureRepository->findBy(["project"=>$id])
        ]);
    }

}
