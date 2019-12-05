<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route ("/category", name="category")
     */

class ToolController extends AbstractController
{
    /**
     * @Route ("/tool", name="tool")
     */

    public function tool(): Response
    {
        return $this->render('offres.html.twig');
    }
}
