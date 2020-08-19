<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Step3Fixtures extends Fixture
{
    public function __construct()
    {

    }

    public static function getGroups(): array
    {
        return ['group3'];
    }

    public function load(ObjectManager $manager)
    {
        // Mentor
        $profile = new Profile();
        $profile
            ->setName('Mes expériences')
            ->setCreated(new \DateTime())
            ->setType('offre')
            ->setUpdated(new \DateTime());
        $entityManager = $manager;
        $entityManager->persist($profile);
        $entityManager->flush();

        // Mentoré
        $profile = new Profile();
        $profile
            ->setName('Mes objectifs')
            ->setType('demande')
            ->setCreated(new \DateTime())
            ->setUpdated(new \DateTime());
        $entityManager = $manager;
        $entityManager->persist($profile);
        $entityManager->flush();
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