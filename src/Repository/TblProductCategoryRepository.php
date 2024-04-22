<?php

namespace App\Repository;

use App\Entity\TblProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TblProductCategory>
 *
 * @method TblProductCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method TblProductCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method TblProductCategory[]    findAll()
 * @method TblProductCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TblProductCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TblProductCategory::class);
    }

    /**
     * @return TblProductCategory[] Returns an array of TblProductCategory objects
     */
    public function getProductsByCategory(int $categoryId): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.category = :val')
            ->setParameter('val', $categoryId)
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?TblProductCategory
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
