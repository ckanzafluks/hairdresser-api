<?php
namespace App\Services\Users;

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

class UserService
{


    public function updateAds(User $userUpdated, User $userinitiale) /* @var $userUpdated User */ /* @var $userinitiale User */
    {
        $userinitiale->setName($userUpdated->getName());
        $userinitiale->setActive($userUpdated->getBirthday());
        $userinitiale->setEmail($userUpdated->getEmail());
        $userinitiale->setAddress($userUpdated->getAddress());
        $userinitiale->setPhone1($userUpdated->getPhone1());
        $userinitiale->setDescriptionProfil($userUpdated->getDescriptionProfil());
        $userinitiale->setFirstname($userUpdated->getFirstname());
        $userinitiale->setBirthday($userUpdated->getBirthday());



        return $userinitiale;
    }



}

