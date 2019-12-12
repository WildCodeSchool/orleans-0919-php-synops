<?php


namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article", name="article_")
 */
class ArticleController extends AbstractController
{
    /**
     *  @Route("/", name="list")
     * @return  Response
     */
    public function list():Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        return $this->render('article/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     *  @Route("/show/{slug}", name="show")
     * @return  Response
     */
    public function show(?string $slug):Response
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => $slug]);
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'slug' => $slug
        ]);
    }
}
