<?php

namespace App\Repository;

use App\Entity\UserFileIdentity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFileIdentity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFileIdentity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFileIdentity[]    findAll()
 * @method UserFileIdentity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFileIdentityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFileIdentity::class);
    }

    // /**
    //  * @return UserFileIdentity[] Returns an array of UserFileIdentity objects
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
    public function findOneBySomeField($value): ?UserFileIdentity
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
