<?php

namespace App\Repository;

use App\Entity\TblCartProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TblCartProduct>
 *
 * @method TblCartProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method TblCartProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method TblCartProduct[]    findAll()
 * @method TblCartProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TblCartProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TblCartProduct::class);
    }

//    /**
//     * @return TblCartProduct[] Returns an array of TblCartProduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TblCartProduct
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
