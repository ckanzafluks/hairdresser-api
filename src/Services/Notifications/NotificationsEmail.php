<?php
namespace App\Services\Notifications;

use App\Entity\CountVisiteurs;
use App\Services\CustomException;
use App\Services\FrontUri;
use FOS\UserBundle\Mailer\MailerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
use Twig\Environment;


use Symfony\Component\Mime\Email as EmailCustom;

/**
 * Class NotificationsEmail
 * @package App\Services\Notifications
 */
class NotificationsEmail
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var FrontUri
     */
    private $frontUriService;
    /**
     * @var CustomException
     */
    private $customException;

    /**
     * NotificationsEmail constructor.
     * @param EntityManagerInterface $entityManager
     * @param FrontUri $frontUriService
     * @param \Symfony\Component\Mailer\MailerInterface $mailer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FrontUri $frontUriService,
        \Symfony\Component\Mailer\MailerInterface $mailer,
        CustomException $customException
    )
    {
        $this->entityManager = $entityManager;
        $this->frontUriService = $frontUriService;
        $this->mailer  = $mailer;
        $this->customException = $customException;
    }

    public function sendEmailWelcomeParticuliers(User $user, $token)
    {
        $mailIsSent = 0;

        try {
            $href = $this->frontUriService->getFrontURL() . "/account-activation/token/" . $token;

            $templateEmail = new TemplatedEmail(); /* @var $templateEmail TemplatedEmail */

            $templateEmail
                ->addFrom('noReply@clictacoiffe.com')
                ->from('noReply@clictacoiffe.com')
                ->sender('noReply@clictacoiffe.com')
                ->replyTo('noReply@clictacoiffe.com')
                ->to(new Address($user->getEmail()))
                ->subject('Bienvenue sur Clictacoiffe')
                ->htmlTemplate('emails/welcome-particulier.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'user' => $user,
                    'href' => $href
                ])
            ;
            $this->mailer->send($templateEmail);
            $mailIsSent = 1;

        } catch (\Exception $e) {
            $this->customException->addExceptionAndSendMail($e);
        }
        return $mailIsSent;
    }

    public function sendEmailWelcomePros(User $user, $token)
    {
        $mailIsSent = 0;

        try {

            $href = $this->frontUriService->getFrontURL() . "/account-activation/token/" . $token;

            $templateEmail = new TemplatedEmail(); /* @var $templateEmail TemplatedEmail */

            $templateEmail
                ->addFrom('noReply@clictacoiffe.com')
                ->from('noReply@clictacoiffe.com')
                ->sender('noReply@clictacoiffe.com')
                ->replyTo('noReply@clictacoiffe.com')
                ->to(new Address($user->getEmail()))
                ->subject('Bienvenue sur Clictacoiffe')
                ->htmlTemplate('emails/welcome-pro.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'user' => $user,
                    'href' => $href
                ])
            ;
            $this->mailer->send($templateEmail);
            $mailIsSent = 1;

        } catch (\Exception $e) {
            $this->customException->addExceptionAndSendMail($e);
        }
        return $mailIsSent;
    }


    /**
     * @param User $user
     * @param $token
     * @return int
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
   public function sendEmailActivationAccount(User $user, $token)
   {
       $mailIsSent = 0;

       try {

           $href = $this->frontUriService->getFrontURL() . "/account-activation/token/" . $token;
           //$href = "http://clictacoiffure/account-activation/token/".$token;
           //dump(get_class_methods('Symfony\Bridge\Twig\Mime\TemplatedEmail'));

           $templateEmail = new TemplatedEmail(); /* @var $templateEmail TemplatedEmail */

           $templateEmail
               ->addFrom('noReply@clictacoiffe.com')
               ->from('noReply@clictacoiffe.com')
               ->sender('noReply@clictacoiffe.com')
               ->replyTo('noReply@clictacoiffe.com')
               ->to(new Address($user->getEmail()))
               ->subject('Activation de votre compte')
               ->htmlTemplate('emails/mail_activation_account.html.twig')

               // pass variables (name => value) to the template
               ->context([
                   'expiration_date' => new \DateTime('+7 days'),
                   'username' => $user->getUsername(),
                   'href'     => $href
               ])
           ;
           $this->mailer->send($templateEmail);
           $mailIsSent = 1;

       } catch (\Exception $e) {
           $this->customException->addExceptionAndSendMail($e);
       }
       return $mailIsSent;
   }

}

