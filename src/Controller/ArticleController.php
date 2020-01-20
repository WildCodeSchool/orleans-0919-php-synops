<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Section;
use App\Form\ArticleSearchType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\SectionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actualite", name="article_")
 */
class ArticleController extends AbstractController
{
    const NB_MAX_ARTICLES_PER_PAGE = 9;

    /**
     * @Route("s/{page}", name="list", requirements={"page" = "\d+"}, methods={"GET"}, defaults={"page" = 1})
     * @return  Response
     */
    public function list(
        int $page,
        ArticleRepository $articleRepository,
        Request $request
    ): Response {
        /**
         * @var FormFactory
         */
        $formFactory = $this->get('form.factory');
        $form = $formFactory->createNamed('', ArticleSearchType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $section = $data['section'];
            $articles = $articleRepository->findLikeName($search, $section);
        } else {
            $articles = $articleRepository->findBy([], ['date' => 'DESC']);
            $articles = $articleRepository->findAllPaginateAndSort($page);
        }

        $nbArticles = count($articleRepository->findAllPaginateAndSort());

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'nbPages' => ceil($nbArticles / self::NB_MAX_ARTICLES_PER_PAGE),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="show")
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
