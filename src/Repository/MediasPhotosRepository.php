<?php

namespace App\Repository;

use App\Entity\MediasPhotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediasPhotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediasPhotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediasPhotos[]    findAll()
 * @method MediasPhotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediasPhotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediasPhotos::class);
    }

    // /**
    //  * @return MediasPhotos[] Returns an array of MediasPhotos objects
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
    public function findOneBySomeField($value): ?MediasPhotos
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
