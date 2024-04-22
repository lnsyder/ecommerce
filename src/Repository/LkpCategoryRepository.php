<?php

namespace App\Repository;

use App\Entity\LkpCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LkpCategory>
 *
 * @method LkpCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method LkpCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method LkpCategory[]    findAll()
 * @method LkpCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LkpCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LkpCategory::class);
    }

//    /**
//     * @return LkpCategory[] Returns an array of LkpCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LkpCategory
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
