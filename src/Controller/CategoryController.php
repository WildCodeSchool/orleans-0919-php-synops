<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/offres", name="offres")
 */

class CategoryController extends AbstractController
{
    /**
     * @Route ("/category", name="category")
     */

    public function category(): Response
    {
        return $this->render('offres.html.twig');
    }
}
