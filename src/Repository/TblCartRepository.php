<?php

namespace App\Repository;

use App\Entity\TblCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TblCart>
 *
 * @method TblCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method TblCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method TblCart[]    findAll()
 * @method TblCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TblCartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TblCart::class);
    }

//    /**
//     * @return TblCart[] Returns an array of TblCart objects
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

//    public function findOneBySomeField($value): ?TblCart
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
