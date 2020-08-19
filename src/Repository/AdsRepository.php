<?php

namespace App\Repository;

use App\Entity\Ads;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ads|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ads|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ads[]    findAll()
 * @method Ads[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ads::class);
    }

    /**
     * Retourne la liste des annonces d'un utilisateur selon le type d'annonce ( mentor ou mentoré )
     * @param $profileName
     * @param $userId
     * @return mixed
     */
    public function getAdsByProfileName($profileName, $userId)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.profile', 'p')
            ->andWhere('p.name = :pname')
            ->andWhere('a.user = :uid')
            ->setParameter('pname', $profileName)
            ->setParameter('uid',   $userId)
            ->getQuery()
            ->getResult();
    }

    public function getAdsByCategory($type, $price ='null', $ssCategory ='tous', $valueCategorie='tous')
    {


        switch ($type){
            case 'catégorie':
                if($ssCategory != 'tous') {

                    return $this->createQueryBuilder('a')
                        ->innerJoin('a.category', 's')
                        ->innerJoin('a.subCategory', 'l')
                        ->andWhere('s.name = :pname')
                        ->andWhere('l.name =:ssCategory')
                        ->setParameter('pname', $valueCategorie)
                        ->setParameter('ssCategory', $ssCategory)
                        ->getQuery()
                        ->getResult();
                }else{
                    return $this->createQueryBuilder('a')
                        ->innerJoin('a.category', 's')
                        ->andWhere('s.name = :pname')
                        ->setParameter('pname', $valueCategorie)
                        ->getQuery()
                        ->getResult();
                }
                break;
            case 'prix':
                return $this->createQueryBuilder('a')
                    ->andWhere('a.price BETWEEN :from AND :to')
                    ->setParameter(':from', 0)
                    ->setParameter(':to', $price)
                    ->getQuery()
                    ->getResult();
                break;
            case 'created':
                return $this->createQueryBuilder('a')
                    ->orderBy('a.created', 'DESC')
                    ->getQuery()
                    ->getResult();
                break;
            default:
            {
                return $this->createQueryBuilder('a')
                    ->orderBy('a.created', 'DESC')
                    ->getQuery()
                    ->getResult();
            }
        }

    }

    public function getAdsByProfileId($profileId, $userId)
    {
        return $this->createQueryBuilder('a')
            ->join('a.profile', 'p')
            ->andWhere('p.id = :profileId')
            ->andWhere('a.user = :uid')
            ->andWhere('a.id is not null ')
            ->setParameter('profileId', $profileId)
            ->setParameter('uid',   $userId)
            ->getQuery()
            ->getResult();
    }

    public function getdataResearch($categorie, $sscategori, $typeoffre, $price, $search)
    {
        dump($categorie, $sscategori, $typeoffre, $price, $search);
        $qr = $this->createQueryBuilder('a');


        $qr->innerJoin('a.category', 's')
            ->innerJoin('a.profile', 'p')
            ->innerJoin('a.user', 'u');

        if($categorie == 'tous'){
            $qr->andWhere('s.name  IS NOT NULL');
        }else{
            $qr ->andWhere('s.name = :categorie')
                ->setParameter('categorie', $categorie);
        }

        if($typeoffre == 'tous'){
            $qr->andWhere('p.type IS NOT NULL');
        }else{
            $qr->andWhere(' p.type= :type')
            ->setParameter('type', $typeoffre);
        }

        if($search){
            dump("ici");
            $qr->andWhere('a.name like  :search')
                ->orWhere('u.name like :search')
                ->setParameter('search', '%'.$search.'%');
        }

        if($sscategori == 'tous'){

        }else{


            $qr ->innerJoin('a.subCategory', 'l')
                ->andWhere('l.name =:ssCategory')
                ->setParameter('ssCategory', $sscategori);
        }

        $qr->andWhere('a.price BETWEEN :from AND :to')
        ->setParameter('from', 0)
        ->setParameter('to', $price);


         return $qr ->getQuery()
                    ->getResult();;


    }


    /**
     * @param $adsId
     * @return mixed
     */
    public function getMediasMusics($adsId)
    {
        return $this->createQueryBuilder('a')
            ->select('mm.id')
            ->innerJoin('a.medias', 'm')
            ->innerJoin('m.mediasMusics', 'mm')
            ->andWhere('m.ads = :adsId')
            ->setParameter('adsId', $adsId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $adsId
     * @return mixed
     */
    public function getMediasVideos($adsId)
    {
        return $this->createQueryBuilder('a')
            ->select('mv.id')
            ->innerJoin('a.medias', 'm')
            ->innerJoin('m.mediasVideos', 'mv')
            ->andWhere('m.ads = :adsId')
            ->setParameter('adsId', $adsId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $adsId
     * @return mixed
     */
    public function getMediasPhotos($adsId)
    {
        return $this->createQueryBuilder('a')
            ->select('mp.id')
            ->innerJoin('a.medias', 'm')
            ->innerJoin('m.mediasPhotos', 'mp')
            ->andWhere('m.ads = :adsId')
            ->setParameter('adsId', $adsId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $adsId
     * @return mixed
     */
    public function getMediasArticles($adsId)
    {
        return $this->createQueryBuilder('a')
            ->select('ma.id')
            ->innerJoin('a.medias', 'm')
            ->innerJoin('m.mediasArticles', 'ma')
            ->andWhere('m.ads = :adsId')
            ->setParameter('adsId', $adsId)
            ->getQuery()
            ->getResult();
    }
    
    


    // /**
    //  * @return Ads[] Returns an array of Ads objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ads
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
