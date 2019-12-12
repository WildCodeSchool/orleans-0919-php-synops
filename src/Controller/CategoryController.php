<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tool;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route ("/", name="category")
     * @return Response
     */
    public function category(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        if (!$categories) {
            throw $this
                ->createNotFoundException("Aucune catégorie trouvé dans le tableau des catégories");
        }

        return $this->render(
            'home/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * @Route ("/", name="tool")
     * @return Response
     */
    public function tool(): Response
    {
        $tools = $this->getDoctrine()
            ->getRepository(Tool::class)
            ->findAll();

        if (!$tools) {
            throw $this
                ->createNotFoundException("Aucun outil trouvé dans le tableau des catégories");
        }


        return $this->render(
            'home/index.html.twig',
            ['tools' => $tools]
        );
    }
}
