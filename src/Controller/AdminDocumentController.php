<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/admin/document")
 */
class AdminDocumentController extends AbstractController
{
    /**
     * @Route("/", name="document_index", methods={"GET"})
     */
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('admin_document/index.html.twig', [
            'documents' => $documentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="document_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $document->setUpdatedAt(new DateTime());
            $entityManager->persist($document);
            $entityManager->flush();
            $this->addFlash('success', 'L\'outil a été créé');

            return $this->redirectToRoute('tool_index');
        }

        return $this->render('admin_document/new.html.twig', [
            'admin_document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="document_show", methods={"GET"})
     */
    public function show(Document $document): Response
    {
        return $this->render('admin_document/show.html.twig', [
            'admin_document' => $document,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="document_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document->setUpdatedAt(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'outil a été modifié');

            return $this->redirectToRoute('tool_index');
        }

        return $this->render('admin_document/edit.html.twig', [
            'admin_document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="document_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Document $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($document);
            $entityManager->flush();
            $this->addFlash('danger', 'L\'outil a été supprimé');
        }

        return $this->redirectToRoute('tool_index');
    }
}
