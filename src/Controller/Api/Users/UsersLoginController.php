<?php

namespace App\Controller\Api\Users;

use App\Repository\UserRepository;
use JMS\Serializer\Expression\ExpressionEvaluator;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;


/**
 * Class UsersLoginController
 * @package App\Controller\Api\Users
 */
class UsersLoginController extends AbstractController
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
    public function __construct(UserRepository $userRepository, SerializerInterface $serializer, RequestStack $requestStack)
    {
        $this->_userRepository = $userRepository;
        $this->_serializer = $serializer;
    }

    /**
     * @Route("/api/users/login", name="api_users_login", methods={"POST"})
     */
    public function loginAction(Request $request)
    {
        $data = $request->getContent();


        var_dump($data);die;

        /**
        $listUsers = $this->_userRepository->findAll();
        $data = $this->_serializer->serialize($listUsers, 'json', SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        **/
    }















}
