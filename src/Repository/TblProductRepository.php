<?php

namespace App\Repository;

use App\Entity\TblProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TblProduct>
 *
 * @method TblProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method TblProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method TblProduct[]    findAll()
 * @method TblProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TblProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TblProduct::class);
    }

//    public function findOneBySomeField($value): ?TblProduct
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
