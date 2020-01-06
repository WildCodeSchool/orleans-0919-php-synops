<?php

namespace App\Controller;

use App\Entity\Tool;
use App\Form\ToolType;
use App\Repository\CategoryRepository;
use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin_tool")
 */
class AdminToolController extends AbstractController
{
    /**
     * @Route("/", name="tool_index", methods={"GET"})
     */
    public function index(ToolRepository $toolRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin_tool/index.html.twig', [
            'tools' => $toolRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="tool_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tool = new Tool();
        $form = $this->createForm(ToolType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tool);
            $entityManager->flush();
            $this->addFlash('success', 'L\'outil a été créé');

            return $this->redirectToRoute('tool_index');
        }

        return $this->render('admin_tool/new.html.twig', [
            'admin_tool' => $tool,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tool_show", methods={"GET"})
     */
    public function show(Tool $tool): Response
    {
        return $this->render('admin_tool/show.html.twig', [
            'admin_tool' => $tool,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tool_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tool $tool): Response
    {
        $form = $this->createForm(ToolType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'outil a été modifié');

            return $this->redirectToRoute('tool_index');
        }

        return $this->render('admin_tool/edit.html.twig', [
            'admin_tool' => $tool,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tool_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tool $tool): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tool->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tool);
            $entityManager->flush();
            $this->addFlash('danger', 'L\'outil a été supprimé');
        }

        return $this->redirectToRoute('tool_index');
    }
}
