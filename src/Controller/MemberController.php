<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\ToolRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/espace-client", name="customer_space")
     * @IsGranted("ROLE_USER")
     * @return  Response
     */
    public function show(): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
