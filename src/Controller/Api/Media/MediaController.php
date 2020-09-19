<?php

namespace App\Controller\Api\Media;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\MediasPhotos;
use App\Repository\AdsRepository;
use App\Repository\UserRepository;
use App\Repository\VotesRepository;
use App\Services\CheckUser\CheckUserService;
use JMS\Serializer\Expression\ExpressionEvaluator;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class VoteController
 * @package App\Controller\Api\Vote
 */
class MediaController extends BaseController implements RequiredMethods
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
     * @var VotesRepository
     */
    private $_adsRepository;

    private  $_checkUserService;

    /**
     * UsersController constructor.
     * @param AdsRepository $adsRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(AdsRepository  $adsRepository, SerializerInterface $serializer, RequestStack $requestStack, CheckUserService  $checkUserService)
    {
        $this->_adsRepository = $adsRepository;
        $this->_serializer = $serializer;
        $this->_checkUserService =$checkUserService;

    }

    /**
     * @Route("/free-api/vote/", name="api_vote", methods={"GET"})
     */
    public function listAction(Request $request)
    {

    }

    /**
     * @Route("/api/media/photo/create", name="api_mediaPhoto_create", methods={"POST","PUT"})
     */
    public function createAction(Request $request)
    {
        $user = $this->_checkUserService->getUserByToken($request);

        if(empty($user)){
            return new JsonResponse('error user with token', Response::HTTP_FORBIDDEN);
        }
        $ads = $this->_adsRepository->find($request->get('idAds'));

        if(empty($ads)){
            return new JsonResponse('ads not found', Response::HTTP_NOT_FOUND);
        }elseif ($user != $ads->getUser() && !$this->_checkUserService->isAdmin($user)){

            return new JsonResponse('no allowed', Response::HTTP_FORBIDDEN);
        }



        $data = $request->files->get('picture'); /** @var UploadedFile $data */
        $name = $request->get('name');


        $mediaphoto = new MediasPhotos();
        $mediaphoto->traitementPhoto($data, '/medias',$user->getId());
        $mediaphoto->setAds($ads);
        $mediaphoto->setName($name);
        $mediaphoto->setCreated(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($mediaphoto);
        $em->flush();

        return new JsonResponse('sucess mediaPhoto added', Response::HTTP_OK);
    }

    /**
     * @Route("/free-api/vote/{id}/", requirements={"id"="\d+"}, name="api_vote_id", methods={"GET"})
     */
    public function getAction(Request $request)
    {

    }

    /**
     * @Route("/api/vote/{id}/",  requirements={"id"="\d+"}, methods={"PATCH"})
     */
    public function updateAction(Request $request)
    {




    }













}
