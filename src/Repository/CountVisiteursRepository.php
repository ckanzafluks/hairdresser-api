<?php

namespace App\Repository;

use App\Entity\CountVisiteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CountVisiteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountVisiteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountVisiteurs[]    findAll()
 * @method CountVisiteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountVisiteursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountVisiteurs::class);
    }

    // /**
    //  * @return CountVisiteurs[] Returns an array of CountVisiteurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CountVisiteurs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function dataFromDbCreated($from, $to)
    {

        return $this->createQueryBuilder('t')
            ->andWhere('t.created BETWEEN :from AND :to')
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->orderBy('t.created', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
