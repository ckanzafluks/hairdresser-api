<?php

namespace App\Repository;

use App\Entity\Presession;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Presession|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presession|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presession[]    findAll()
 * @method Presession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presession::class);
    }

    /**
     * @param $user
     * @param $type : 'offre' ou 'demande' de la table Profile
     * @param bool $status
     * @return int|mixed|string
     */
    public function getListPreSession(User $user, $type='sent', $filtre='all')
    {
        $queryBuilder = $this->createQueryBuilder('p');
        if($type == 'sent') {
            switch ($filtre) {
                case 'all':
                    $queryBuilder
                        ->andWhere('p.author = :author')
                        ->setParameter('author', $user)
                        ->andWhere('p.lastEvents=1');
                    break;

                case 'validated':
                    $queryBuilder
                        ->andWhere('p.author = :author')
                        ->setParameter('author', $user)
                        ->innerJoin('p.status', 's')
                        ->andWhere('s.value = '.Status::STATUS_VALIDE);
                    break;

                case 'cancel':
                    $queryBuilder
                        ->andWhere('p.author = :author')
                        ->setParameter('author', $user)
                        ->innerJoin('p.status', 's')
                        ->andWhere('p.lastEvents=1')
                        ->andWhere('s.value = '.Status::STATUS_ANNULE);
                    break;

                case 'waiting':
                    $queryBuilder
                        ->andWhere('p.author = :author')
                        ->setParameter('author', $user)
                        ->innerJoin('p.status', 's')
                        ->andWhere('p.lastEvents=1')
                        ->andWhere('s.value = '.Status::STATUS_ATTENTE_VALIDATION);
                    break;

                default:
                    return [];
                    break;
            }
            $result = $queryBuilder->orderBy('p.id', 'DESC')
                //->setMaxResults(10)
                ->getQuery()
                ->getResult();

            return $result;
        }

        elseif ($type =='received'){

            switch ($filtre) {
                case 'validated':
                    $queryBuilder
                        ->andWhere('p.receiver = :receiver')
                        ->setParameter('receiver', $user)
                        ->innerJoin('p.status', 's')
                        ->andWhere('s.value ='.Status::STATUS_VALIDE)
                        ->andWhere('p.lastEvents=1');
                    break;


                case 'all':
                    $queryBuilder
                        ->andWhere('p.receiver = :receiver')
                        ->setParameter('receiver', $user)
                        ->innerJoin('p.status', 's')
                        ->andWhere('p.lastEvents=1');
                    break;

                case 'cancel':
                    $queryBuilder
                        ->andWhere('p.receiver = :receiver')
                        ->setParameter('receiver', $user)
                        ->leftJoin('p.status', 's')
                        ->andWhere('s.value = '.Status::STATUS_ANNULE)
                        ->andWhere('p.lastEvents=1');
                    break;

                case 'waiting':
                    $queryBuilder
                        ->andWhere('p.receiver = :receiver')
                        ->setParameter('receiver', $user)
                        ->leftJoin('p.status', 's')
                        ->andWhere('s.value = '.Status::STATUS_ATTENTE_VALIDATION)
                        ->andWhere('p.lastEvents=1');
                    break;

                default:
                    return [];
                    break;
            }

            return $result = $queryBuilder->orderBy('p.id', 'DESC')
                //->setMaxResults(10)
                ->getQuery()
                ->getResult();
        }
    }


    // /**
    //  * @return Presession[] Returns an array of Presession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Presession
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
