<?php
namespace App\Services\Users;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    private $mailer;

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
    public function __construct(EntityManagerInterface $entity, RequestStack $requestStack, SessionInterface $session, \Swift_Mailer $mailer, ContainerInterface $container)
    {
        $this->entity  = $entity;
        $this->request = $requestStack->getCurrentRequest();
        $this->session = $session;
        $this->mailer  = $mailer;
        $this->templating = $container->get('templating');
    }


    /**
     * @param User $userEmail
     * @todo : A faire
     */
    public function sendEmailResetPassword(User $userEmail)
    {


        /**
        $message = (new \Swift_Message('xxxxxxxx'))
            ->setFrom('contact@xxxxx.com', 'XXXXXXXXXXX')
            ->setSender('contact@xxxxx.com', 'XXXXXXXXXXX')
            ->setTo('xxxxxxx')
            ->setBody(
                $this->templating->render(
                    'emails/fos_user/reset-password.email.html.twig',
                    [
                        'params1' => 'value1',
                        'params2' => 'value2',
                        'params3' => 'value3',
                        'host'    => $_SERVER['HTTP_ORIGIN']
                    ]
                ),
                'text/html'
            );
        return $this->mailer->send($message);
        **/

    }

    /**
     * @param User $user
     */
    public function sendEmailConfirmPassword(User $user)
    {
        //.....


        /**
        $message = (new \Swift_Message('xxxxxxxx'))
        ->setFrom('contact@xxxxx.com', 'XXXXXXXXXXX')
        ->setSender('contact@xxxxx.com', 'XXXXXXXXXXX')
        ->setTo('xxxxxxx')
        ->setBody(
        $this->templating->render(
        'emails/fos_user/reset-password-confirm.email.html.twig',
        [
        'params1' => 'value1',
        'params2' => 'value2',
        'params3' => 'value3',
        'host'    => $_SERVER['HTTP_ORIGIN']
        ]
        ),
        'text/html'
        );
        return $this->mailer->send($message);
         **/
    }




}