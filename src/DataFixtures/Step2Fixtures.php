<?php

namespace App\DataFixtures;

use App\Entity\Messagerie;
use App\Entity\User;
use App\Entity\UserNotifications;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use KnpU\LoremIpsumBundle\KnpUIpsum;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Step2Fixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var KnpUIpsum
     */
    private $knpUIpsum;

    public static function getGroups(): array
    {
        return ['group2'];
    }

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, KnpUIpsum $knpUIpsum)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->knpUIpsum = $knpUIpsum;
    }

    public function encodePassword($user, $plainPassword)
    {
        return $this->passwordEncoder->encodePassword($user, $plainPassword);
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 30; $i++) {

            $user = new User();
            $plainPassword = 'password';
            $newPassword = $this->encodePassword($user, $plainPassword);

            $paragraphe = $this->knpUIpsum->getWords(30);

            $hashcode = $this->knpUIpsum->getWords(1). '_' .$this->knpUIpsum->getWords(1);
            $user
                ->setEnabled(true)
                //
                ->setRoles(['ROLE_USER'])
                ->setName($hashcode)
                ->setLastname('lastname_'.$hashcode)
                ->setUsername($hashcode)
                ->setEmail('email_' . $hashcode . '@gmail.com')
                ->setEnabled(1)
                ->setFirstname('firstname_'.$hashcode)
                ->setPassword($newPassword)
                ->setPlainPassword($plainPassword)
                ->setDescriptionProfil($paragraphe)
            ;

            $userNotification = new UserNotifications();
            $userNotification->setAssuranceUpdate(true);
            $userNotification->setCompatibility(true);
            $userNotification->setContractProposition(true);
            $userNotification->setMail(true);
            $userNotification->setContractUpdate(true);
            $userNotification->setNewComment(true);
            $userNotification->setNewMessage(true);

            $entityManager = $manager;
            $entityManager->persist($user);
            $userNotification->setUser($user);
            $entityManager->persist($userNotification);
            $entityManager->flush();

            /* @var $user User */

            //$maxMessage = 101;
            /*
            for ($b =0; $b<= $maxMessage; $b++)
            {
                $message = new Messagerie();
                $message->setSource($user);
                $message->setDestinataire($user);
                $message->setCreated(new \DateTime());
                $message->setMessages("un nouveau message à moi même");
                $message->setObjet("note pour moi même. ".$b);
                $message->setReadCheck(true);
                $message->setUsers($user);

                $entityManager->persist($message);
                $entityManager->flush();

            }
            */
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