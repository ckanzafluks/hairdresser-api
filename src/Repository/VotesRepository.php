<?php

namespace App\Repository;

use App\Entity\Votes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Votes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Votes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Votes[]    findAll()
 * @method Votes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotesRepository  extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Votes::class);
    }

    /**
     * @param $limit
     * @param $offset
     * @return \Pagerfanta\Pagerfanta
     */
    public function getAll($limit, $offset)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->orderBy('a.id', 'asc')
        ;
        return $this->paginate($qb, $limit, $offset);
    }

    public function getVotes($userId)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.idReceiver = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('v.created', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Votes[] Returns an array of Votes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Votes
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
