<?php

namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use JMS\Serializer\SerializerInterface;

/**
 * Class AuthenticationSuccessListener
 * @package App\EventListener
 */
class AuthenticationSuccessListener {

    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     * @var SerializerInterface
     */
    private $_serializer;

    /**
     * AuthenticationSuccessListener constructor.
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->_entityManager = $entityManager;
        $this->_serializer = $serializer;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $user = $event->getUser(); /* @var $user User */

        $user->setJwtToken($event->getData()['token']);
        $this->_entityManager->persist($user);
        $this->_entityManager->flush();

        //$userJson = $this->_serializer->serialize($user, 'json');
        $event->setData([
            'code'    => $event->getResponse()->getStatusCode(),
            'payload' => $event->getData(),
            'userId'  => $user->getId(),
            'userEmail'  => $user->getEmail(),
        ]);
    }
}