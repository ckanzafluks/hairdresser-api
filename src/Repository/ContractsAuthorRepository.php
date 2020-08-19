<?php

namespace App\Repository;

use App\Entity\ContractsAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractsAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractsAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractsAuthor[]    findAll()
 * @method ContractsAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractsAuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractsAuthor::class);
    }

    // /**
    //  * @return ContractsAuthor[] Returns an array of ContractsAuthor objects
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
    public function findOneBySomeField($value): ?ContractsAuthor
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findallContratPagination( $page, $limitResult)
    {
        $firstresult = ($page-1) * $limitResult;

        return $this->createQueryBuilder('m')
            ->orderBy('m.created', 'DESC')
            ->setFirstResult($firstresult)
            ->setMaxResults($limitResult)
            ->getQuery()
            ->getResult()
            ;
    }
}
