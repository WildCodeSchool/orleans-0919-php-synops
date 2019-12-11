<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class HomeController extends AbstractController
{
    const LIMIT = 3;
    const LIMIT_PARTNERS = 5;

    /**
     * @Route("/", name="index")
     */

    public function index(ArticleRepository $articleRepository, PartnerRepository $partnerRepository)
    {
        $articles = $articleRepository->findBy([], ['date' => 'DESC'], self::LIMIT, 0);
        $partners = $partnerRepository->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'partners' => $partners
        ]);
    }
}
