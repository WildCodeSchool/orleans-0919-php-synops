<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Contact;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function index(Request $request, MailerInterface $mailer, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_from'))
                ->subject("Vous avez un message")
                ->html($this->renderView('contact/email/notification.html.twig', [
                    'contactFormData' => $contactFormData,
                ]));

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé à Syn\'Ops');

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView(),
            'categories' => $categories,
        ]);
    }
}
