<?php

namespace App\Repository;

use App\Entity\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Status|null find($id, $lockMode = null, $lockVersion = null)
 * @method Status|null findOneBy(array $criteria, array $orderBy = null)
 * @method Status[]    findAll()
 * @method Status[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusRepository extends ServiceEntityRepository
{
    CONST ACTIF   = 1;
    CONST INACTIF = 0;
    CONST ATTENTE_VALIDATION_MENTORE = 2;
    CONST ATTENTE_VALIDATION_MENTOR  = 3;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }

    /**
     *
     * @param $value
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getStatus($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.value = :statusValue')
            ->setParameter('statusValue', $value)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
    }


    // /**
    //  * @return Status[] Returns an array of Status objects
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
    public function findOneBySomeField($value): ?Status
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
