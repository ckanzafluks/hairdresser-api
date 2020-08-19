<?php

namespace App\Repository;

use App\Entity\PresessionMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PresessionMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresessionMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresessionMessages[]    findAll()
 * @method PresessionMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresessionMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresessionMessages::class);
    }

    // /**
    //  * @return PresessionMessages[] Returns an array of PresessionMessages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PresessionMessages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
