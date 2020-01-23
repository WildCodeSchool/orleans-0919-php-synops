<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
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
     * @Route("/export/membres", name="admin_member_export", methods={"GET"})
     * @param UserRepository $userRepository
     * @return Response
     */
    public function exportMember(UserRepository $userRepository): Response
    {
        $csv = $this->renderView('admin_member/export_user.csv.twig', [
            'users' => $userRepository->findAll(),
        ]);

        $response = new Response($csv);
        $response->setStatusCode(200);

        $response->headers->set('Content-Type', 'application/csv;charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export_members.csv"');

        return $response;
    }

    /**
     * @Route("/{id}", name="admin_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
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
     * @Route("/retirer-acces/{id}", name="admin_remove_access", methods={"POST"})
     */
    public function removeAccess(User $user): Response
    {
        $user->setRoles(['ROLE_ACCESS_REMOVED']);
        $user->setRemoveAccessDate(new DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_member_index');
    }
}
