<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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


    public function __construct(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $this->_userRepository = $userRepository;
        $this->_serializer = $serializer;
    }


    /**
     * @Route("/api/users/", name="api_users")
     * @Method({"GET"})
     */
    public function list()
    {
        $listUsers = $this->_userRepository->findAll();
        $data = $this->_serializer->serialize($listUsers, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/users/{id}", name="api_users_id")
     * @Method({"GET"})
     */
    public function get(Request $request)
    {
        $id = $request->get('id');
        $data = $this->_userRepository->find($id);
        $response = new Response($this->_serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/users/create", name="api_users_create")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->getContent();
        $user = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Users', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @todo: a faire
     */
    public function update(Request $request)
    {

    }













}
