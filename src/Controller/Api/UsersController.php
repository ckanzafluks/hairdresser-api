<?php

namespace App\Controller\Api;

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

/**
 * Class UsersController
 * @package App\Controller\Api
 */
class UsersController extends AbstractController implements RequiredMethods
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
     * @Route("/api/users/", name="api_users")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $listUsers = $this->_userRepository->findAll();
        $data = $this->_serializer->serialize($listUsers, 'json', SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/users/create/", name="api_users_create")
     * @Method({"PUT"},{"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        //if ( $this->get('validator')->validate($data) ) {
            $user = $this->_serializer->deserialize($data, 'App\Entity\User', 'json', SerializationContext::create()->setGroups(array('create')));
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        //}


        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/users/{id}/", name="api_users_id")
     * @Method({"GET"})
     */
    public function getAction(Request $request)
    {
        $id = $request->get('id');
        $data = $this->_userRepository->find($id);
        $response = new Response($this->_serializer->serialize($data, 'json'), SerializationContext::create()->setGroups(array('get')));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/users/{id}/", name="api_users_update")
     * @Method({"PATCH"})
     */
    public function updateAction(Request $request)
    {

    }













}
