<?php

namespace App\Repository;

use App\Entity\LkpPaymentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LkpPaymentMethod>
 *
 * @method LkpPaymentMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method LkpPaymentMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method LkpPaymentMethod[]    findAll()
 * @method LkpPaymentMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LkpPaymentMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LkpPaymentMethod::class);
    }

//    /**
//     * @return LkpPaymentMethod[] Returns an array of LkpPaymentMethod objects
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

//    public function findOneBySomeField($value): ?LkpPaymentMethod
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
