<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/membres", name="admin_member_index", methods={"GET"})
     */
    public function indexMember(UserRepository $userRepository): Response
    {
        return $this->render('admin_member/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="admin_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_member_index');
    }

    /**
     * @Route("/valider-membre/{id}", name="admin_validate_member", methods={"POST"})
     */
    public function validateMember(User $user): Response
    {
        $user->setRoles(['ROLE_MEMBER']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_member_index');
    }

    /**
     * @Route("/retirer-acces/{id}", name="admin_remove_acces", methods={"POST"})
     */
    public function removeAcces(User $user): Response
    {
        $user->setRoles(['ROLE_ACCES_REMOVED']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_member_index');
    }
}
