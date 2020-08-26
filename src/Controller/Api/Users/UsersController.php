<?php

namespace App\Controller\Api\Users;

use App\Controller\Api\RequiredMethods;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Users\CheckFields;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\Context;
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
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
     * @var CheckFields
     */
    private $_checkFields;

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
     * @Route("/api/users/", name="api_users", methods={"GET"})
     */
    public function listAction()
    {
        $listUsers = $this->_userRepository->findAll();
        $data = $this->_serializer->serialize($listUsers, 'json', SerializationContext::create()->setGroups(array('list'))->setSerializeNull(true));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/users/", name="api_users_create", methods={"PUT","POST"})
     */
    public function createAction(Request $request)
    {

        $data = $request->getContent();
        $user = $this->_serializer->deserialize($data, 'App\Entity\User', 'json'); /* @var $user User */

        $isValid = $this->_checkFields->isValidEntity($user);
        if ( $isValid['totalErrors'] > 0 ) {
            return new Response($this->_serializer->serialize($isValid,'json'), Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $user
                ->setEnabled(false)
                ->setPlainPassword($user->getPassword())
                ->setPassword($this->_passwordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
                ));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new Response($user->getId(), Response::HTTP_CREATED);
        }
    }

    /**
     * @Route("/api/users/{id}/", name="api_users_id", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function getAction(Request $request)
    {
        $returnData = [];
        $id = $request->get('id');
        $data = $this->_userRepository->find($id);
        if ( $data ) {
            $returnData = $data;
        }
        $dataJson = $this->_serializer->serialize($returnData, 'json', SerializationContext::create()->setGroups(array('list'))->setSerializeNull(true));
        $response = new Response($dataJson);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/users/{id}",name="api_users_edit", methods={"PATCH"})
     */
    public function updateAction(Request $request)
    {

    }

}