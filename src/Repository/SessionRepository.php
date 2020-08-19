<?php

namespace App\Repository;

use App\Entity\Presession;
use App\Entity\Session;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function getListSession(Presession $preSession,User $user)
    {
        return
            $queryBuilder = $this->createQueryBuilder('session')
                ->innerJoin('session.status', 'status')
                ->innerJoin('session.presession', 'presession')
                //->andWhere('presession.mentor = :mentor')
                ->andWhere('presession.mentore = :mentor OR presession.mentor = :mentor')
                ->andWhere('presession.id = :id')
                ->setParameter('mentor', $user)
                ->setParameter('id', $preSession->getId())
                ->orderBy('session.id', 'DESC')

                //->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;

        return $result;
    }

    public function getWaitingPayments()
    {
        return
            $queryBuilder = $this->createQueryBuilder('session')
                ->innerJoin('session.status', 's')
                ->andWhere('s.value = '.Status::STATUS_PAIEMENT_EN_ATTENTE_ACCEPTATION)
                ->getQuery()
                ->getResult();
    }

    public function getCanceledSessions()
    {
        return
            $queryBuilder = $this->createQueryBuilder('session')
                ->innerJoin('session.status', 's')
                ->andWhere('s.value = '.Status::STATUS_DEMANDE_ANNULATION_REFUSEE)
                ->orWhere('s.value = '.Status::STATUS_DEMANDE_ANNULATION_ACCEPTEE)
                ->getQuery()
                ->getResult();
    }

    public function accountGetListSessionsReceived(User $user)
    {
        return
            $queryBuilder = $this->createQueryBuilder('session')
                ->innerJoin('session.status', 'status')
                ->innerJoin('session.presession', 'presession')
                ->andWhere('presession.mentor = :mentor')
                ->andWhere(
                    'status.value = '. Status::STATUS_DEMANDE_ANNULATION_REFUSEE . ' OR 
                     status.value = '.  Status::STATUS_DEMANDE_ANNULATION_ACCEPTEE . ' OR
                     status.value = '.  Status::STATUS_SESSION_TERMINEE)
                ->setParameter('mentor', $user)
                ->getQuery()
                ->getResult();
    }

    public function accountGetListSessionsDone(User $user)
    {
        return
            $queryBuilder = $this->createQueryBuilder('session')
                ->innerJoin('session.status', 'status')
                ->innerJoin('session.presession', 'presession')
                ->andWhere('presession.mentore = :mentor')
                ->andWhere('status.value = '. Status::STATUS_DEMANDE_ANNULATION_REFUSEE)
                ->orWhere('status.value = '.  Status::STATUS_DEMANDE_ANNULATION_ACCEPTEE)
                ->orWhere('status.value = '.  Status::STATUS_SESSION_TERMINEE)
                ->setParameter('mentor', $user)
                ->getQuery()
                ->getResult();
    }



    // /**
    //  * @return Sessions[] Returns an array of Sessions objects
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
    public function findOneBySomeField($value): ?Sessions
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
