<?php

namespace App\Controller\Api\Users;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\CheckUser\CheckUserService;
use App\Services\Users\CheckFields;
use App\Services\Users\UserService;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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

    private $_checkUserService;
    private $_userService; 
    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(UserRepository $userRepository, SerializerInterface $serializer,CheckFields $checkFields, UserPasswordEncoderInterface $passwordEncoder, CheckUserService $checkUserService, UserService $userService)
    {
        $this->_userRepository = $userRepository;

        $this->_serializer = $serializer;

        $this->_checkFields = $checkFields;

        $this->_passwordEncoder = $passwordEncoder;

        $this->_checkUserService = $checkUserService;
        
        $this->_userService = $userService;
    }

    /**
     * @Route("/free-api/users/", name="api_users", methods={"GET"})
     */
    public function listAction(Request $request)
    {

        $page   = $request->query->get('page',1);
        $offset = ($page*self::TOTAL_RESULTS_PER_PAGE)-1;

        $listUsersPaginator = $this->_userRepository->getAll(self::TOTAL_RESULTS_PER_PAGE, $offset);

        $results['totalPage']    = $listUsersPaginator->getNbPages();
        $results['totalResults'] = $listUsersPaginator->getNbResults();
        $results['results']      = $listUsersPaginator->getCurrentPageResults();

        $data = $this->_serializer->serialize($results, 'json', SerializationContext::create()->setGroups(array('list'))->setSerializeNull(true));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/free-api/users/", name="api_users_create", methods={"PUT","POST"})
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
               // ->setSuperAdmin(true)
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
     * @Route("/api/users/updateid}",name="api_users_update", methods={"PUT"})
     */
    public function updateAction(Request $request)
    {
        $id = $request->get('id');
        $data = $request->getContent();
        $userinitiale = $this->_userRepository->find($id);
        $user = $this->_checkUserService->getUserByToken($request); /* @var $user User */


        if (empty($user))
        {
            return new JsonResponse('error user with token', Response::HTTP_FORBIDDEN);
        }

        if(empty($userinitiale)){
            return new JsonResponse("Ads not found", Response::HTTP_NOT_FOUND);
        }elseif ($userinitiale == $user or $this->_checkUserService->isAdmin($user))
        {
            $userUpdate = $this->_serializer->deserialize($data,'App\Entity\Ads', 'json');
            $userUpdated = $this->_userService->updateAds($userUpdate, $userinitiale); ////

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("User modified", Response::HTTP_ACCEPTED);

        }else{
            return new JsonResponse("no allowed", Response::HTTP_FORBIDDEN);

        }

    }
    

    /**
     * @Route("/api/users/deleted/{id}",name="api_users_deleted", methods={"PUT"})
     */
    public function deletedAction(Request $request)
    {
        $id = $request->get('id');
        $user = $this->_checkUserService->getUserByToken($request);
        
        if(empty($user))
        {
            return new JsonResponse("user no found", Response::HTTP_NOT_FOUND);
        }
        
        if ($this->_checkUserService->isAdmin($user))
        {
            $userWilldeteled = $this->_userRepository->find($id);
            if(empty($userWilldeteled)){return new JsonResponse("user cannot be deleted, user not found", Response::HTTP_NOT_FOUND);}
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($userWilldeteled);
            $em->flush();
        }else{
            return new JsonResponse("you are not allow to deleted user", Response::HTTP_UNAUTHORIZED);
        }
    }



}