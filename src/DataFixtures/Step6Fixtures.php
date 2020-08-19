<?php

namespace App\DataFixtures;

use App\Entity\CountVisiteurs;
use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Step6Fixtures extends Fixture
{
    public function __construct()
    {

    }

    public static function getGroups(): array
    {
        return ['group6'];
    }

    public function load(ObjectManager $manager)
    {
        return;
        $d=0;
        $day = new \DateTime();
        $day->modify('-30 days');
        $limit = 50;
        for($i =0; $i < 30;$i++)
        {
            for ($o=0;$o<$limit;$o++)
            {
                $count = new CountVisiteurs();
                $count->setAddress('ipAddress');
                $count->setCreated($day);
                $count->setContext('fixtures');
                $manager->persist($count);
                $manager->flush();

            }

            $limit = $limit+10;
            $day->add(new \DateInterval('P1D'));

        }


    }



}