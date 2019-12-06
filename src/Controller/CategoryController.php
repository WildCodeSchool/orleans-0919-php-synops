<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tool;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/", name="offres")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route ("/", name="category")
     * @return Response A response instance
     */

    public function category(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        if (!$categories) {
            throw $this->createNotFoundException('No program found in program\'s table.');
        }

        $tools = $this->getDoctrine()
            ->getRepository(Tool::class)
            ->findBy(['categories' => $categories]);

        return $this->render(
            'home/index.html.twig',
            ['categories' => $categories,
            'tools' => $tools]
        );
    }
}
