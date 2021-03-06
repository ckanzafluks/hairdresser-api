<?php

namespace App\Repository;

use App\Entity\Messagerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Messagerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messagerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messagerie[]    findAll()
 * @method Messagerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Messagerie::class);
    }

    // /**
    //  * @return Messagerie[] Returns an array of Messagerie objects
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
    public function findOneBySomeField($value): ?Messagerie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findBygroupeChat($id)
    {
        return $this->createQueryBuilder('m')
        ->andWhere('m.groupechat = :val')
        ->setParameter('val', $id)
        ->orderBy('m.created', 'DESC')
        ->setMaxResults(50)
        ->getQuery()
        ->getResult()
        ;
    }

    public function findReceptionMailByUserWithPagination($value, $page, $limitResult)
    {
        $firstresult = ($page-1) * $limitResult;

        return $this->createQueryBuilder('m')
            ->andWhere('m.destinataire = :val')
            ->setParameter('val', $value)
            ->orderBy('m.created', 'DESC')
            ->setFirstResult($firstresult)
            ->setMaxResults($limitResult)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findSentMailByUserWithPagination($value, $page, $limitResult)
    {
        $firstresult = ($page-1) * $limitResult;

        return $this->createQueryBuilder('m')
            ->andWhere('m.source = :val')
            ->setParameter('val', $value)
            ->orderBy('m.created', 'DESC')
            ->setFirstResult($firstresult)
            ->setMaxResults($limitResult)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getNbReceptionBox($value) {

        return $this->createQueryBuilder('l')

            ->select('COUNT(l)')
            ->where('l.destinataire = :val')
            ->setParameter('val', $value)
            ->getQuery()

            ->getSingleScalarResult();

    }

    public function getNbReceptionBoxNotRead($value) {

        return $this->createQueryBuilder('l')

            ->select('COUNT(l)')
            ->where('l.destinataire = :val')
            ->andWhere('l.readCheckEmetteur = 0')
            ->andWhere('l.readCheckDestinataire = 0')
            ->setParameter('val', $value)
            ->getQuery()

            ->getSingleScalarResult();

    }
}
