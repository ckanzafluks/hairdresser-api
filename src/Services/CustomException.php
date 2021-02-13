<?php

namespace App\Services;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

/**
 * Class CustomException
 * @package App\Services
 */
class CustomException {

    /**
     * @var \Exception
     */
    private $exception;

    const USERS = ['camillekanza@gmail.com', 'jal.djellouli@gmail.com '];

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * CustomException constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer  = $mailer;
    }

    /**
     * @param \Exception $exception
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function addExceptionAndSendMail(\Exception $exception) {
        $this->exception = $exception;
        $this->_sendMail();
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    private function _sendMail() {

        foreach (self::USERS as $userEmail) {

            try {
                $templateEmail = new TemplatedEmail();
                /* @var $templateEmail TemplatedEmail */

                $templateEmail
                    ->addFrom('noReply@clictacoiffe.com')
                    ->from('noReply@clictacoiffe.com')
                    ->sender('contact@clictacoiffe.com')
                    ->replyTo('errors@clictacoiffe.com')
                    ->to($userEmail)
                    ->subject('Une exception est survenue sur la plateforme!')
                    ->htmlTemplate('emails/exception_error.html.twig')
                    ->context([
                        'errorMessage' => $this->exception->__toString()
                    ]);
                $this->mailer->send($templateEmail);
            } catch (\Exception $e) {

            }
        }


    }




}
