<?php

namespace App\Repository;

use App\Entity\MediasArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediasArticles|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediasArticles|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediasArticles[]    findAll()
 * @method MediasArticles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediasArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediasArticles::class);
    }

    // /**
    //  * @return MediasArticles[] Returns an array of MediasArticles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MediasArticles
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
