<?php

namespace App\Controller\Api\Users;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Users\CheckFields;
use App\Services\Users\UserPasswordResetService;
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
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $this->_userRepository = $userRepository;
        $this->_serializer = $serializer;
    }

    /**
     * @Route("/free-api/users/reset-password/{email}", name="api_users_reset_password", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function resetPasswordAction(Request $request, UserPasswordResetService $userPasswordResetService)
    {
        // we load user by email
        $userEmail = $this->_userRepository->findOneBy(['email',$request->get('email')]);

        // we send email
        $result = $userPasswordResetService->sendEmailResetPassword($userEmail);

        // json return
        $dataReturn = [
            'success' => $result,
        ];
        return new Response( json_encode($dataReturn), Response::HTTP_CREATED);
    }

    /**
     * @Route("/free-api/users/confirm-reset-password/{token}", name="api_users_confirm_password", methods={"GET"})
     * @param Request $request
     * @param UserPasswordResetService $userPasswordResetService
     * @return Response
     */
    public function confirmResetPasswordAction(Request $request, UserPasswordResetService $userPasswordResetService)
    {
        // Load by token
        $userEntity = $this->_userRepository->findOneBy(['XXXXXtokenXXXX' => $request->get('XXXXXtokenXXXXX')]); //......

        // Update user (we set active=1)
        // ...... @todo: .....

        // We send confirm email activation
        $result = $userPasswordResetService->sendEmailConfirmPassword($userEntity);

        // json return
        $dataReturn = [
            'success' => $result,
        ];
        return new Response( json_encode($dataReturn), Response::HTTP_CREATED);
    }


}