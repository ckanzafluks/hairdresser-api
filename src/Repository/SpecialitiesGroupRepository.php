<?php

namespace App\Repository;

use App\Entity\SpecialitiesGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpecialitiesGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialitiesGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialitiesGroup[]    findAll()
 * @method SpecialitiesGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialitiesGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialitiesGroup::class);
    }

    // /**
    //  * @return SpecialitiesGroup[] Returns an array of SpecialitiesGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpecialitiesGroup
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
