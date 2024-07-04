<?php

namespace App\Repository\Product;

use App\Entity\Product\Model;
use App\Filter\ModelFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Model>
 */
class ModelRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly PaginatorInterface $paginator,
    ) {
        parent::__construct($registry, Model::class);
    }

    public function findWithFilter(ModelFilter $filter): PaginationInterface
    {
        $query = $this->createQueryBuilder('m')
            ->leftJoin('m.marque', 'ma');

        if ($filter->getSearch()) {
            $query
                ->andWhere('m.name LIKE :search')
                ->setParameter('search', "{$filter->getSearch()}%");
        }

        if ($filter->getBrands()) {
            $query
                ->andWhere('ma.id IN (:brands)')
                ->setParameter('brands', $filter->getBrands());
        }

        return $this->paginator->paginate(
            $query->getQuery(),
            $filter->getPage(),
            $filter->getLimit(),
        );
    }
    //    /**
    //     * @return Model[] Returns an array of Model objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Model
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
