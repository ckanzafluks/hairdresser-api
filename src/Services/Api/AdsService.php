<?php
namespace App\Services\Api;

use App\Entity\Ads;
use App\Entity\CountVisiteurs;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\GroupeChat;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Mime\Test\Constraint\EmailAddressContains;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class AdsService
{


    public function updateAds(Ads $adsUpdated, Ads $adsinitiale) /* @var $adsUpdated Ads */ /* @var $adsinitiale Ads */
    {
        $adsinitiale->setPrice($adsUpdated->getPrice());
        $adsinitiale->setCategory($adsUpdated->getCategory());
        $adsinitiale->setActive($adsUpdated->getActive());
        $adsinitiale->setName($adsUpdated->getName());
        $adsinitiale->setDescription($adsUpdated->getDescription());
        $adsinitiale->setSubCategory($adsUpdated->getSubCategory());
        $adsinitiale->setUpdated(new \DateTime());

        return $adsinitiale;
    }



}

