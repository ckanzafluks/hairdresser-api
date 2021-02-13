<?php

namespace App\Controller\Api\Users;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Users\CheckFields;
use App\Services\Users\UserPasswordResetService;
use FOS\UserBundle\Util\TokenGenerator;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * Class ForgotPasswordController
 * @package App\Controller\Api\Users
 */
class ResetPasswordController extends BaseController
{

    /**
     * @var UserRepository
     */
    private $_userRepository;

    /**
     * @var SerializerInterface
     */
    private $_serializer;

    private $_tokenStorage;

    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(UserRepository $userRepository, SerializerInterface $serializer, TokenStorageInterface $tokenStorage)
    {
        $this->_userRepository = $userRepository;
        $this->_serializer = $serializer;
        $this->_tokenStorage = $tokenStorage;

    }

    /**
     * @Route("/free-api/users/reset-password/", name="api_users_reset_password", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function resetPasswordAction(Request $request, UserPasswordResetService $userPasswordResetService)
    {
        $userEmail = $this->_userRepository->findOneBy(['email' => $request->request->get('email')]);
        if (empty($userEmail)) {
            return new JsonResponse('0', Response::HTTP_NOT_FOUND);
        } else {
            $result = $userPasswordResetService->sendEmailResetPassword($userEmail);
            return new JsonResponse($result, Response::HTTP_CREATED);
        }
    }

    /**
     * @Route("/free-api/users/confirm-reset-password/", name="api_users_confirm_password", methods={"POST"})
     * @param Request $request
     * @param UserPasswordResetService $userPasswordResetService
     * @return Response
     */
    public function confirmResetPasswordAction(Request $request, UserPasswordResetService $userPasswordResetService)
    {
        // Load by token
        $userEntity = $this->_userRepository->findOneBy(['token' => $request->get('token')]);

        if (empty($userEntity) || empty($request->request->get('password'))) {
            return new JsonResponse('0', Response::HTTP_NOT_FOUND);
        } else {

            $userEntity->setPlainPassword($request->request->get('password'));
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            //$result = $userPasswordResetService->sendEmailConfirmPassword($userEntity);

            return new JsonResponse("1", Response::HTTP_CREATED);
        }
    }
}