<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use App\Repository\CategoryRepository;
use App\Repository\PartnerRepository;
use App\Repository\TeamRepository;
use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class HomeController extends AbstractController
{
    const LIMIT = 3;

    /**
     * @Route("/", name="index")
     * @param ArticleRepository $articleRepository
     * @param PartnerRepository $partnerRepository
     * @param CategoryRepository $categoryRepository
     * @param ToolRepository $toolRepository
     * @param TeamRepository $teamRepository
     * @param DocumentRepository $documentRepository
     */

    public function index(
        ArticleRepository $articleRepository,
        PartnerRepository $partnerRepository,
        CategoryRepository $categoryRepository,
        ToolRepository $toolRepository,
        TeamRepository $teamRepository,
        DocumentRepository $documentRepository
    ) {
        $articles = $articleRepository->findBy([], ['date' => 'DESC'], self::LIMIT, 0);
        $partners = $partnerRepository->findAll();
        $categories = $categoryRepository->findAll();
        $tools = $toolRepository->findAll();
        $teams = $teamRepository->findAll();
        $documents = $documentRepository->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'partners' => $partners,
            'categories' => $categories,
            'tools' => $tools,
            'teams' => $teams,
            'documents' => $documents
        ]);
    }

    public function navbar(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findBy([], ['sector' => 'ASC']);

        return $this->render('_categories_in_nav.html.twig', ['categories' => $categories]);
    }
}
