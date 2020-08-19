<?php

namespace App\Repository;

use App\Entity\GroupeChat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GroupeChat|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeChat|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeChat[]    findAll()
 * @method GroupeChat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeChat::class);
    }

    // /**
    //  * @return GroupeChat[] Returns an array of GroupeChat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeChat
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findBygroupe($id)
    {
        return $this->createQueryBuilder('g')
        ->andWhere('g.user02 = :val')
        ->orWhere('g.user01 = :val1')
        ->setParameter('val', $id)
        ->setParameter('val1', $id)
        ->orderBy('g.lastMessage', 'DESC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function checkGroupExistSourceDestinateur($idSource, $idDestinater)
    {
        return $this->createQueryBuilder('g')
        ->leftJoin('g.user01', 'e')
        ->leftJoin('g.user02', 'f')
        ->leftJoin('g.messageries', 'h')
        ->andWhere('g.user02 = :val')
        ->andWhere('g.user01 = :val1')
        ->setParameter('val', $idSource)
        ->setParameter('val1', $idDestinater)
        ->orderBy('g.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function checkGroupExistDestinateurSource($idSource, $idDestinater)
    {
        return $this->createQueryBuilder('g')
        ->leftJoin('g.user01', 'e')
        ->leftJoin('g.user02', 'f')
        ->leftJoin('g.messageries', 'h')
        ->andWhere('g.user02 = :val')
        ->andWhere('g.user01 = :val1')
        ->setParameter('val', $idDestinater)
        ->setParameter('val1', $idSource)
        ->orderBy('g.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
        ;
    }
}
