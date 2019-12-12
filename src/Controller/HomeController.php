<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class HomeController extends AbstractController
{
    const LIMIT = 3;

    /**
     * @Route("/", name="index")
     */

    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy([], ['date' => 'DESC'], self::LIMIT, 0);

        return $this->render('home/index.html.twig', ['articles' => $articles]);
    }
}
