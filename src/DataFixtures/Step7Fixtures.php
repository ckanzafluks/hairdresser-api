<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\CountVisiteurs;
use App\Entity\Presession;
use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Step7Fixtures extends Fixture
{
    public function __construct()
    {

    }

    public static function getGroups(): array
    {
        return ['group7'];
    }

    public function load(ObjectManager $manager)
    {
        $liste = [
            'bijouterie',
            'design',
            'joaillerie',
            'maroquinerie',
            'parfumerie',
            'plomberie',
            'soudure',
            'cinéma',
            'Développement personnel',
            'photographie',
            'Dessin',
            'Peinture',
            'Sculpture',
            'Musique',
            'Théâtre',
            'Bricolage',
            'Communication',
            'Couture',
            'Cuisine',
            'Jeux',
            'Jeux vidéo',
            'Informatique',
            'Jardinage',
            'Ébénisterie',
            'Langues',
            'Santé bien être',
            'Architecture',
            'Sciences',
            'Sports',
            'Danse',
        ];

        foreach ($liste as $value)
        {
            $categorie = new Category();
            $categorie->setName($value);

            $manager->persist($categorie);
            $manager->flush();
        }

    }



}