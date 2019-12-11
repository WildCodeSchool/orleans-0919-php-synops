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
        if (!$articles) {
            throw $this->createNotFoundException(
                'No Articles found in program\'s table.'
            );
        }
        return $this->render('article/list.html.twig', [
            'articles' => $articles,
        ]);
    }
}
