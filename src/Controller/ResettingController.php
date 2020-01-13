<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResettingType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Route("/renouvellement-mot-de-passe")
 */
class ResettingController extends AbstractController
{
    /**
     * @Route("/requete", name="request_resetting")
     * @throws TransportExceptionInterface
     */
    public function request(
        Request $request,
        MailerInterface $mailer,
        TokenGeneratorInterface $tokenGenerator,
        UserRepository $userRepository
    ) {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $user = $userRepository->findOneBy(['email' => $form->getData()['email']]);
            if (!$user) {
                $this->addFlash('warning', "Cet email n'est pas enregistré.");

                return $this->redirectToRoute("request_resetting");
            }

            $user->setToken($tokenGenerator->generateToken());
            $manager->flush();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($user->getEmail())
                ->subject('Réinitialisation mot de passe')
                ->html($this->renderView('resetting/mail.html.twig', [
                    'user' => $user
                ]));

            $mailer->send($email);
            $this->addFlash(
                'success',
                "Un mail va vous être envoyé
                 afin que vous puissiez renouveller votre mot de passe."
            );

            return $this->redirectToRoute("index");
        }

        return $this->render('resetting/request.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/{token}", name="resetting")
     */
    public function resetting(User $user, $token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($user->getToken() === null || $token !== $user->getToken()) {
            throw new AccessDeniedHttpException();
        }

        $form = $this->createForm(ResettingType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData()->getPassword();
            $encoded = $passwordEncoder->encodePassword($user, $password);
            $user->setPassword($encoded);

            $user->setToken(null);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "Votre mot de passe à bien été changé.");

            return $this->redirectToRoute('app_login');
        }

        return $this->render('resetting/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
