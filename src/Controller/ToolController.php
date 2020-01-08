<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tool;
use App\Repository\CategoryRepository;
use App\Repository\ToolRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToolController extends AbstractController
{
    /**
     * @Route("outils/{slug}", name="tool")
     * @IsGranted("ROLE_USER")
     * @return Response
     */

    public function index(
        CategoryRepository $categoryRepository,
        Category $category,
        ToolRepository $toolRepository
    ): Response {
        $categories = $categoryRepository->findAll();
        $tools = $toolRepository->findAll();

        return $this->render('tool/index.html.twig', [
            'category' => $category,
            'categories' => $categories,
            'tools' => $tools,
        ]);
    }
}
