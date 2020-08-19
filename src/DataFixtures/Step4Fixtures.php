<?php

namespace App\DataFixtures;

use App\Entity\Ads;
use App\Entity\Category;
use App\Entity\Medias;
use App\Entity\MediasArticles;
use App\Entity\MediasMusics;
use App\Entity\MediasPhotos;
use App\Entity\MediasVideos;
use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use KnpU\LoremIpsumBundle\KnpUIpsum;

/**
 * Class Step4Fixtures
 * @package App\DataFixtures
 */
class Step4Fixtures extends Fixture
{

    /**
     * @var \App\Repository\UserRepository
     */
    private $_userRepo;

    /**
     * @var \App\Repository\ProfileRepository
     */
    private $_profileRepo;

    /**
     * @var KnpUIpsum
     */
    private $_knpUIpsum;

    public static function getGroups(): array
    {
        return ['group4'];
    }


    public function __construct(\App\Repository\UserRepository $userRepo, \App\Repository\ProfileRepository $profileRepo, KnpUIpsum $knpUIpsum)
    {
        $this->_userRepo = $userRepo;
        $this->_profileRepo = $profileRepo;
        $this->_knpUIpsum = $knpUIpsum;
    }

    public function load(ObjectManager $manager)
    {


        $listUsers          = $this->_userRepo->findAll();
        $listProfiles       = $this->_profileRepo->findAll();

        foreach ($listProfiles as $profil) {

            // Vv définir le nom du type d'annonces ( soit expérience, soit objectif )
            $type = $profil->getName()=='Mes expériences'?'Expérience ' : 'Objectif ';
            $category = $manager->getRepository(Category::class)->findAll();

            foreach ($listUsers as $user) {

                $totalAdsPerUsers   = rand(0,3);
                for ($i=0;$i<=$totalAdsPerUsers;$i++) {
                    $randcat = array_rand($category,1);

                    // creation d'une annonce ( expérience ou objectif )
                    $ads = new Ads();
                    $ads
                        ->setUser($user)
                        ->setProfile($profil)
                        ->setDescription($this->_knpUIpsum->getWords(30))
                        ->setName($type . md5(time()))
                        ->setCategory($category[$randcat])
                        ->setPrice(60);


                    $manager->persist($ads);

                    // creation d'un media
                    $medias = new Medias();
                    $medias
                        ->setName('media_' . $user->getId())
                        ->setAds($ads);
                    // Medias générique ou non générique aléatoire
                    if ( rand(0,1) ) {
                        $medias->setUser($user);
                    }
                    $manager->persist($medias);

                    // créer les 4 types de medias

                    // sons
                    for ($i=0;$i<=rand(1,3);$i++) {
                        $mediasSound = new MediasMusics();
                        $mediasSound->setName('audio n° '.$i);
                        $mediasSound->setPathfile('uploads/users/sounds/default.mp3');
                        $mediasSound->setMedias($medias);
                        $mediasSound->setCreated(new \DateTime());
                        $manager->persist($mediasSound);
                    }

                    // photos
                    for ($i=0;$i<=rand(1,3);$i++) {
                        $mediasPhoto = new MediasPhotos();
                        $mediasPhoto->setName('image n° '.$i);
                        $mediasPhoto->setPathfile('uploads/users/default.png');
                        $mediasPhoto->setMedias($medias);
                        $manager->persist($mediasPhoto);
                    }

                    // videos
                    for ($i=0;$i<=rand(1,3);$i++) {
                        $mediasVideos = new MediasVideos();
                        $mediasVideos->setName('video n° ' . $i);
                        $mediasVideos->setMedias($medias);
                        $mediasVideos->setUri('https://www.youtube.com/embed/LnKw8qm1XRk');
                        $manager->persist($mediasVideos);
                    }

                    // articles
                    for ($i=0;$i<=rand(1,3);$i++) {
                        $mediasArticles = new MediasArticles();
                        $mediasArticles->setName('article n° ' . $i);
                        $mediasArticles->setDescription($this->_knpUIpsum->getParagraphs(3));
                        $mediasArticles->setMedias($medias);
                        $manager->persist($mediasArticles);
                    }


                    $manager->flush();
                }





            }
        }


    }

    /*

    public function getDependencies()
    {
        return array(
            ProfilPictureFixtures::class,
        );
    }

    */

}