<?php
namespace App\Services\Notifications;

use App\Entity\CountVisiteurs;
use FOS\UserBundle\Mailer\MailerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\GroupeChat;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Test\Constraint\EmailAddressContains;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;
use Symfony\Component\Mime\Address;

class NotificationsEmail
{

    private $_entityManager;
    private $_mailer;


    public function __construct( EntityManagerInterface $entityManager, \Symfony\Component\Mailer\MailerInterface $mailer)
    {
        $this->_entityManager = $entityManager;
        $this->_mailer = $mailer;
    }


   public function SendEmailActivationAccount($user, $token)
   {
       $href = "http://clictacoiffure/account-activation/token/".$token;

       $email = (new TemplatedEmail())
           ->from('fabien@example.com')
           ->to(new Address('jal.djellouli@gmail.com'))
           ->subject('Activation compte')

           ->htmlTemplate('mail/mail_activation_account.html.twig')

           // pass variables (name => value) to the template
           ->context([
               'expiration_date' => new \DateTime('+7 days'),
               'username' => $user->getUsername(),
               'href'     => $href
           ])
       ;

       $this->_mailer->send($email);
   }

}

