<?php

namespace App\Controller;

use App\Entity\ContactHome;
use App\Entity\Picture;
use App\Form\ContactHomeType;
use App\Repository\CarouselRepository;
use App\Repository\PictureRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
     * @param MailerInterface $mailer
     * @param Request $request
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function index(
        CarouselRepository $carouselRepository,
        ProjectRepository $projectRepository,
        MailerInterface $mailer,
        Request $request
    ): Response {
        $contact = new ContactHome();
        $form = $this->createForm(ContactHomeType::class, $contact);
        $form->handleRequest($request);
        if (($form->isSubmitted() && $form->isValid())) {
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_to'))
                ->subject('Sujet:' . $contact->getSubject())
                ->html($this->renderView('home/contactHomeEmail.html.twig', ['contact' => $contact]));
            $mailer->send($email);
            return $this->redirectToRoute('confirmation');
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'pictures' => $carouselRepository->findAll(),
            'projets' => $projectRepository->findBy(['view' => "vue"]),
        ]);
    }

    /**
     * @Route ("/confirmation", name="confirmation")
     * @return Response
     */
    public function confirmation(): Response
    {
        return $this->render('contact/contactConfirmation.html.twig', [
        ]);
    }
}
