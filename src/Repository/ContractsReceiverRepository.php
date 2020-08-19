<?php

namespace App\Repository;

use App\Entity\ContractsReceiver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractsReceiver|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractsReceiver|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractsReceiver[]    findAll()
 * @method ContractsReceiver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractsReceiverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractsReceiver::class);
    }

    // /**
    //  * @return ContractsReceiver[] Returns an array of ContractsReceiver objects
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
    public function findOneBySomeField($value): ?ContractsReceiver
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
