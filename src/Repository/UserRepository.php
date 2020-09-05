<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param $limit
     * @param $offset
     * @return \Pagerfanta\Pagerfanta
     */
    public function getAll($limit, $offset)
    {
        $qb = $this
            ->createQueryBuilder('u')
            //->select('u')
            ->where('u.enabled=1')
            //->orderBy('u.id', $order)
        ;
        return $this->paginate($qb, $limit, $offset);
    }


    public function getAllUsers($isActive=1, $exceptedUserId = false)
    {
        $request = $this->createQueryBuilder('o')
            //->select('*')
            //->addSelect('o.username, o.created')
            ->where('o.enabled LIKE :enabled')

            ->setParameter('enabled', $isActive)
            ->orderBy('o.created','asc')
            ;

        if ( !empty($exceptedUserId)) {
            $request
                ->andWhere('o.id NOT LIKE :id')
                ->setParameter('id', $exceptedUserId);
        }


        return $request->getQuery()->getResult();

    }

    public function getMediasMusics($userId)
    {

        return $this->createQueryBuilder('u')
            ->select('DISTINCT(mm.id) as id, mm.name, mm.pathfile, mm.created, mm.updated')
            ->innerJoin('u.ads', 'a')
            ->innerJoin('u.medias', 'm')
            ->innerJoin('m.mediasMusics', 'mm')
            ->andWhere('a.user = :userId')
            ->orWhere('m.user = :userId')
            ->setParameter('userId',   $userId)
            ->getQuery()
            ->getResult();
    }

    public function getMediasVideos($userId)
    {
        return $this->createQueryBuilder('u')
            ->select('DISTINCT(mv.id) as id, mv.name, mv.uri, mv.created, mv.updated')
            ->innerJoin('u.ads', 'a')
            ->innerJoin('u.medias', 'm')
            ->innerJoin('m.mediasVideos', 'mv')
            ->andWhere('a.user = :userId')
            ->orWhere('m.user = :userId')
            ->setParameter('userId',   $userId)
            ->getQuery()
            ->getResult();
    }

    public function getMediasPhotos($userId)
    {
        return $this->createQueryBuilder('u')
            ->select('DISTINCT(mp.id) as id, mp.name, mp.pathfile')
            ->innerJoin('u.ads', 'a')
            ->innerJoin('u.medias', 'm')
            ->innerJoin('m.mediasPhotos', 'mp')
            ->andWhere('a.user = :userId')
            ->orWhere('m.user = :userId')
            ->setParameter('userId',   $userId)
            ->getQuery()
            ->getResult();
    }

    public function getMediasArticles($userId)
    {
        return $this->createQueryBuilder('u')
            ->select('DISTINCT(ma.id) as id, ma.name, ma.description , ma.created, ma.updated')
            ->innerJoin('u.ads', 'a')
            ->innerJoin('u.medias', 'm')
            ->innerJoin('m.mediasArticles', 'ma')
            ->andWhere('a.user = :userId')
            ->orWhere('m.user = :userId')
            ->setParameter('userId',   $userId)
            ->getQuery()
            ->getResult();
    }

    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function loadUserByToken($token)
    {
        return $this->createQueryBuilder('u')
            ->where('u.jwtToken = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function loadUserBy($params)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $params)
            ->setParameter('email', $params)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function searchUser($caractere)
    {

        return $this->createQueryBuilder('o')
        ->select('o.id')
        ->addSelect('o.username')
        ->where('o.username LIKE :name')
        ->setParameter('name', $caractere)
        ->getQuery()
        ->getResult();
    }




}