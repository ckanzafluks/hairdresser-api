<?php

namespace App\Services\Users;


use App\Entity\User;
use App\Services\FrontUri;
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
    private $entityManager;

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
    /**
     * @var FrontUri
     */
    private $frontUriService;


    /***
     * UserPasswordResetService constructor.
     * @param EntityManagerInterface $entity
     * @param RequestStack $requestStack
     * @param SessionInterface $session
     * @param \Swift_Mailer $mailer
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $entityManager, FrontUri $frontUriService, RequestStack $requestStack, SessionInterface $session, \Symfony\Component\Mailer\MailerInterface $mailer, ContainerInterface $container)
    {
        $this->entityManager = $entityManager;
        $this->frontUriService = $frontUriService;
        $this->request = $requestStack->getCurrentRequest();
        $this->session = $session;
        $this->_mailer = $mailer;
        $this->templating = $container->get('templating');
    }


    /**
     * @param User $userEmail
     * @return bool
     */
    public function sendEmailResetPassword(User $userEmail)
    {

        $mailIsSent = 0;
        try {
            $token = md5(uniqid() . time());
            $userEmail->setToken($token);
            $em = $this->entityManager;
            $em->flush();

            $href = $this->frontUriService->getFrontURL() . "/reset-password-confirm/" . $token;
            $email = (new TemplatedEmail())
                ->from('fabien@example.com')
                ->to(new Address($userEmail->getEmail()))
                ->subject('Activation compte')
                ->htmlTemplate('mail/mail_reset_password.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'username' => $userEmail->getUsername(),
                    'href' => $href
                ]);

            $this->_mailer->send($email);
            $mailIsSent = 1;
        } catch (\Exception $e) {

        }
        return $mailIsSent;
    }

    /**
     * @param User $user
     */
    public function sendEmailConfirmPassword(User $user)
    {
        $mailIsSent = 0;
        try {
            $href = $this->frontUriService->getFrontURL();
            $email = (new TemplatedEmail())
                ->from('fabien@example.com')
                ->to(new Address($user->getEmail()))
                ->subject('Activation compte')
                ->htmlTemplate('mail/mail_confirrmation_reset_password.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'username' => $user->getUsername(),
                    'href' => $href
                ]);

            $this->_mailer->send($email);
            $mailIsSent = 1;
        } catch (\Exception $e) {

        }
        return $mailIsSent;
    }


}