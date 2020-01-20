<?php

namespace App\Repository;

use App\Controller\ArticleController;
use App\Entity\Article;
use App\Entity\Section;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int $page
     * @return array
     */

    public function findAllPaginateAndSort($page = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->where('CURRENT_DATE() >= a.date')
            ->orderBy('a.date', 'DESC');

        if ($page !== null) {
            $firstResult = ($page - 1) * ArticleController::NB_MAX_ARTICLES_PER_PAGE;
            $qb->setFirstResult($firstResult)->setMaxResults(ArticleController::NB_MAX_ARTICLES_PER_PAGE);
        }

        return $qb->getQuery()->getResult();
    }

    public function findLikeName(?string $search = '', ?Section $section = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.title LIKE :title')
            ->setParameter('title', '%' . $search . '%');
        if ($section) {
            $qb->andWhere('a.section = :section')
                ->setParameter('section', $section);
        }
        $qb->orderBy('a.date', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
