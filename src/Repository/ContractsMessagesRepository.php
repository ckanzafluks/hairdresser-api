<?php

namespace App\Repository;

use App\Entity\ContractsMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContractsMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractsMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractsMessages[]    findAll()
 * @method ContractsMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractsMessagesRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractsMessages::class);
    }

    /**
     * @param $limit
     * @param $offset
     * @return \Pagerfanta\Pagerfanta
     */
    public function getAllMessageSend($limit, $offset, $author)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->where('a.author = :author')
            ->setParameter('author', $author)
            ->orderBy('a.created', 'asc')
        ;
        return $this->paginate($qb, $limit, $offset);
    }

    public function getAllMessageReceveid($limit, $offset, $author)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->where('a.receiver = :author')
            ->setParameter('author', $author)
            ->orderBy('a.created', 'asc')
        ;
        return $this->paginate($qb, $limit, $offset);
    }


    public function getChannels($userId)
    {
        return $this->createQueryBuilder('c')
            ->select("c.token")
            ->andWhere('c.author = :id')
            ->orWhere('c.receiver = :id')
            ->setParameter('id', $userId)
            //->orderBy('c.id', 'ASC')
            ->groupBy('c.token')
            //->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function loadByToken($token)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.token = :token')
            ->setParameter('token', $token)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

    }



    // /**
    //  * @return ContractsMessages[] Returns an array of ContractsMessages objects
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
    public function findOneBySomeField($value): ?ContractsMessages
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
