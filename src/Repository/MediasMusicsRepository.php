<?php

namespace App\Repository;

use App\Entity\MediasMusics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediasMusics|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediasMusics|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediasMusics[]    findAll()
 * @method MediasMusics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediasMusicsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediasMusics::class);
    }

    // /**
    //  * @return MediasMusics[] Returns an array of MediasMusics objects
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
    public function findOneBySomeField($value): ?MediasMusics
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
