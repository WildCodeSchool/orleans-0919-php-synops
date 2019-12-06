<?php

namespace App\Controller;

use App\Entity\Tool;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/", name="offres")
 */
class ToolController extends AbstractController
{
    /**
     * @Route ("/", name="tool")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $tools = $this->getDoctrine()
            ->getRepository(Tool::class)
            ->findAll();

        if (!$tools) {
            throw $this->createNotFoundException('No program found in program\'s table.');
        }

        return $this->render(
            'home/index.html.twig',
            ['tools' => $tools]
        );
    }
}
