<?php

namespace App\Controller\Api\Users;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Users\CheckFields;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Class ForgotPasswordController
 * @package App\Controller\Api\Users
 */
class ResetPasswordController
{

    /**
     * @var UserRepository
     */
    private $_userRepository;

    /**
     * @var SerializerInterface
     */
    private $_serializer;

    /**
     * @var CheckFields
     */
    private $_checkFields;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $_passwordEncoder;

    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(UserRepository $userRepository, SerializerInterface $serializer,CheckFields $checkFields, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->_userRepository = $userRepository;

        $this->_serializer = $serializer;

        $this->_checkFields = $checkFields;

        $this->_passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/free-api/users/reset-password/{email}", name="api_users_reset_password", methods={"POST"})
     * @param Request $request
     */
    public function resetPasswordAction(Request $request)
    {
        // @todo : a faire
    }

    /**
     * @Route("/free-api/users/confirm-reset-password/{token}", name="api_users_confirm_password", methods={"GET"})
     * @param Request $request
     */
    public function confirmResetPasswordAction(Request $request)
    {
        // Load by token
        $userEntity = $this->_userRepository->findOneBy(['XXXXXtokenXXXX' => $request->get('XXXXXtokenXXXXX')]); //......

        // Update user (active=1)

    }


}