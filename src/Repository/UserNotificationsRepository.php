<?php

namespace App\Repository;

use App\Entity\UserNotifications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserNotifications|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserNotifications|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserNotifications[]    findAll()
 * @method UserNotifications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserNotificationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserNotifications::class);
    }

    public function findByIdUser($userId)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.user = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return UserNotifications[] Returns an array of UserNotifications objects
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
    public function findOneBySomeField($value): ?UserNotifications
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
