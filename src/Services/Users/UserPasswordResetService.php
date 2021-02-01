<?php
namespace App\Services\Users;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Templating\DelegatingEngine;

/**
 * Class UserPasswordResetService
 * @package App\Services\Users
 */
class UserPasswordResetService
{
    /**
     * @var Mailer
     */
    private $_mailer;

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * @var EntityManagerInterface
     */
    private $entity;

    /**
     * @var Request|null
     */
    private $request;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var object|null
     */
    private $templating;


    /***
     * UserPasswordResetService constructor.
     * @param EntityManagerInterface $entity
     * @param RequestStack $requestStack
     * @param SessionInterface $session
     * @param \Swift_Mailer $mailer
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $entity, RequestStack $requestStack, SessionInterface $session, \Symfony\Component\Mailer\MailerInterface $mailer, ContainerInterface $container)
    {
        $this->entity  = $entity;
        $this->request = $requestStack->getCurrentRequest();
        $this->session = $session;
        $this->_mailer  = $mailer;
        $this->templating = $container->get('templating');
    }


    /**
     * @param User $userEmail
     * @todo : A faire
     */
    public function sendEmailResetPassword(User $user, $token)
    {


        $href = "http://clictacoiffure/reset-password-confirm/".$token;

        $email = (new TemplatedEmail())
            ->from('fabien@example.com')
            ->to(new Address($user->getEmail()))
            ->subject('Activation compte')

            ->htmlTemplate('mail/mail_reset_password.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => $user->getUsername(),
                'href'     => $href
            ])
        ;

        $this->_mailer->send($email);

    }

    /**
     * @param User $user
     */
    public function sendEmailConfirmPassword(User $user)
    {
        //.....


        $href = "http://clictacoiffure.com";

        $email = (new TemplatedEmail())
            ->from('fabien@example.com')
            ->to(new Address($user->getEmail()))
            ->subject('Activation compte')

            ->htmlTemplate('mail/mail_confirrmation_reset_password.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'username' => $user->getUsername(),
                'href'     => $href
            ])
        ;

        $this->_mailer->send($email);
    }




}