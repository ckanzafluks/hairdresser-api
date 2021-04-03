<?php

namespace App\Controller\Api\Users;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Notifications\NotificationsEmail;
use App\Services\Users\CheckFields;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Uuid;


/**
 * Class UsersController
 * @package App\Controller\Api
 */
class UsersController extends BaseController implements RequiredMethods
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

    private $_notificationMail;
    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(NotificationsEmail $notifications, UserRepository $userRepository, SerializerInterface $serializer,CheckFields $checkFields, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->_userRepository = $userRepository;

        $this->_serializer = $serializer;

        $this->_checkFields = $checkFields;

        $this->_passwordEncoder = $passwordEncoder;

        $this->_notificationMail = $notifications;

    }

    /**
     * @Route("/free-api/users/", name="api_users", methods={"GET"})
     */
    public function listAction(Request $request)
    {

        $page   = $request->query->get('page',1);
        $offset = ($page*self::TOTAL_RESULTS_PER_PAGE)-1;

        $listUsersPaginator = $this->_userRepository->getAll(self::TOTAL_RESULTS_PER_PAGE, $offset); /* @var $listUsersPaginator Pagerfanta\Pagerfanta */

        //dump($offset);die;

        $results['totalPage']    = $listUsersPaginator->getNbPages()-1;
        $results['totalResults'] = $listUsersPaginator->getNbResults();
        $results['results']      = $listUsersPaginator->getCurrentPageResults();

        //dump($results);
        //die;

        $data = $this->_serializer->serialize($results, 'json', SerializationContext::create()->setGroups(array('list'))->setSerializeNull(true));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/free-api/users/", name="api_users_create", methods={"POST"})
     */
    public function createAction(Request $request)
    {

        $data = $request->getContent();
        $user = $this->_serializer->deserialize($data, 'App\Entity\User', 'json', DeserializationContext::create()->setGroups(array('create'))); /* @var $user User */

        //dump($user);die;
        $isValid = $this->_checkFields->isValidEntity($user);
        if ( $isValid['totalErrors'] > 0 ) {
            return new Response($this->_serializer->serialize($isValid,'json'), Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $user
                ->setEnabled(true)
                ->setPlainPassword($user->getPassword())
               // ->setSuperAdmin(true)
               ->setConfirmationToken(uniqid())
               ->setPassword($this->_passwordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
               ));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $ret = $this->_notificationMail->sendEmailActivationAccount($user, $user->getConfirmationToken());

            $dataReturn = [
                'id'       => $user->getId(),
                'email'    => $user->getEmail(),
                'username' => $user->getUsername(),
                'type'     => $user->getTypeUser(),
                'mailIsSent' => $ret,
            ];
            return new Response( json_encode($dataReturn), Response::HTTP_CREATED
            );
        }
    }

    /**
     * @Route("/free-api/users/{id}/", name="api_users_id", requirements={"id"="\d+"}, methods={"GET"})
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
     * @Route("/api/users/{id}",name="api_users_update", methods={"PUT"})
     */
    public function updateAction(Request $request)
    {

    }

    /**
     * @Route("free-api/users/account-activation", name="api_users_checkToken", methods={"POST"})
     */
    public function accountActivation(Request $request)
    {
        $token = $request->request->get('token');
        $user = $this->_userRepository->findOneBy(['confirmationToken' => $token]);

        if (!isset($user))
        {
            return new JsonResponse('0', Response::HTTP_NOT_FOUND);
        } else {
            if ($token == $user->getConfirmationToken())
            {
                $user->setEnabled(1);
                $user->setUpdated(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return new JsonResponse('1', Response::HTTP_OK);
            }else{
                return new JsonResponse('0', Response::HTTP_UNAUTHORIZED);
            }
        }

    }


    /**
     * @Route("/free-api/mot-de-passe-activation/{email}",name="api_users_cactiveAccount", methods={"POST"})
     */
    public function activeAccountUser()
    {

    }
}