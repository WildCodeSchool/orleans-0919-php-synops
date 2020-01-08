<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article", name="article_")
 */
class ArticleController extends AbstractController
{
    const NB_MAX_ARTICLES_PER_PAGE = 9;

    /**
     * @Route("s/{page}", name="list", requirements={"page" = "\d+"}, methods={"GET"}, defaults={"page" = 1})
     */
    public function list(
        int $page,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $categories = $categoryRepository->findAll();

        $articles = $articleRepository->findAllPagineEtTrie($page);
        $nbArticles = count($articleRepository->findAllPagineEtTrie());

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'nbPages' => ceil($nbArticles / self::NB_MAX_ARTICLES_PER_PAGE),
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/show/{slug}", name="show")
     * @param Article $article
     * @return  Response
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
