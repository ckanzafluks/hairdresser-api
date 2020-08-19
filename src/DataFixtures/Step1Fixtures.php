<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\CountVisiteurs;
use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Step1Fixtures extends Fixture
{

    public static function getGroups(): array
    {
        return ['group1'];
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
            $categorie->setIsActive(1);
            $manager->persist($categorie);
            $manager->flush();
        }


        $subCateg = new SubCategory();
        $subCateg
            ->setIsActive(1)
            ->setName('default')
            ->setCategory($categorie)
            ->setCreated(new \DateTime())
            ->setUpdated(new \DateTime());

        $manager->persist($subCateg);
        $manager->flush();

    }


}
