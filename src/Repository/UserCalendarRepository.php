<?php

namespace App\Repository;

use App\Entity\UserCalendar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserCalendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCalendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCalendar[]    findAll()
 * @method UserCalendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCalendar::class);
    }

    // /**
    //  * @return UserCalendar[] Returns an array of UserCalendar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserCalendar
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
