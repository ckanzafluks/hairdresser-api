<?php

namespace App\Repository;

use App\Entity\SessionRatings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SessionRatings|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionRatings|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionRatings[]    findAll()
 * @method SessionRatings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRatingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SessionRatings::class);
    }

    // /**
    //  * @return SessionRatings[] Returns an array of SessionRatings objects
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
    public function findOneBySomeField($value): ?SessionRatings
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
