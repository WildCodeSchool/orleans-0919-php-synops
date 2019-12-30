<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/member", name="member_")
 */
class MemberController extends AbstractController
{
    /**
     *  @Route("/show/", name="show")
     * @return  Response
     */
    public function show():Response
    {

        return $this->render('member/show.html.twig');
    }
}
