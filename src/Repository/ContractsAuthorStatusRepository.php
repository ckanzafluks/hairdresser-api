<?php

namespace App\Repository;

use App\Entity\ContractsAuthorStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContractsAuthorStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractsAuthorStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractsAuthorStatus[]    findAll()
 * @method ContractsAuthorStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractsAuthorStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractsAuthorStatus::class);
    }

    // /**
    //  * @return ContractsAuthorStatus[] Returns an array of ContractsAuthorStatus objects
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
    public function findOneBySomeField($value): ?ContractsAuthorStatus
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
