<?php

namespace App\Repository;

use App\Entity\TblOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TblOrder>
 *
 * @method TblOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method TblOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method TblOrder[]    findAll()
 * @method TblOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TblOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TblOrder::class);
    }

//    /**
//     * @return TblOrder[] Returns an array of TblOrder objects
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

//    public function findOneBySomeField($value): ?TblOrder
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
