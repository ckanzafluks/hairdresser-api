<?php

namespace App\Controller\Api\Ads;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\Ads;
use App\Entity\User;
use App\Repository\AdsRepository;
use App\Repository\UserRepository;
use App\Services\Ads\AdsService;
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

/**
 * Class AdsController
 * @package App\Controller\Api\Ads
 */
class AdsController extends BaseController implements RequiredMethods
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
     * @var AdsRepository
     */
    private $_adsRepository;
    private $_adsService;
    private $_checkUserService;

    /**
     * UsersController constructor.
     * @param AdsRepository $adsRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(AdsRepository $adsRepository, SerializerInterface $serializer, RequestStack $requestStack, AdsService  $adsService, CheckUserService $checkUserService)
    {
        $this->_adsRepository = $adsRepository;
        $this->_serializer = $serializer;
        $this->_adsService = $adsService;
        $this->_checkUserService = $checkUserService;
    }

    /**
     * @Route("/free-api/ads/", name="api_ads", methods={"GET"})
     */
    public function listAction(Request $request)
    {

        $page   = $request->query->get('page',1);
        $offset = ($page*self::TOTAL_RESULTS_PER_PAGE)-1;
        $listAdsPaginator = $this->_adsRepository->getAll(self::TOTAL_RESULTS_PER_PAGE, $offset);

        $results['totalPage']    = $listAdsPaginator->getNbPages();
        $results['totalResults'] = $listAdsPaginator->getNbResults();
        $results['results']      = $listAdsPaginator->getCurrentPageResults();

        $data = $this->_serializer->serialize($results, 'json', SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/ads/create", name="api_ads_create", methods={"POST","PUT"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $user = $this->_checkUserService->getUserByToken($request);

        if(empty($user)){
            return new JsonResponse('error user with token', Response::HTTP_FORBIDDEN);
        }

        $ads = $this->_serializer->deserialize($data, 'App\Entity\Ads', 'json'); /* @var $ads Ads */
        $ads->setUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($ads);
        $em->flush();


        return new Response('', Response::HTTP_CREATED);
    }

	/**
     * @Route("/free-api/ads/{id}/", requirements={"id"="\d+"}, name="api_ads_id", methods={"GET"})
     */
    public function getAction(Request $request)
    {
        $id = $request->get('id');
        $data = $this->_adsRepository->find($id);
        $response = new Response($this->_serializer->serialize($data, 'json', SerializationContext::create()->setGroups(array('get'))));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/ads/update/{id}/",  requirements={"id"="\d+"},  name="api_ads_update", methods={"PATCH"})
     */
    public function updateAction(Request $request)
    {
        $id = $request->get('id');
        $data = $request->getContent();
        $adsinitiale = $this->_adsRepository->find($id);
        $user = $this->_checkUserService->getUserByToken($request); /* @var $user User */


        if (empty($user))
        {
            return new JsonResponse('error user with token', Response::HTTP_FORBIDDEN);
        }

        if(empty($adsinitiale)){
            return new JsonResponse("Ads not found", Response::HTTP_NOT_FOUND);
        }elseif ($adsinitiale->getUser() == $user or $this->_checkUserService->isAdmin($user))
        {
            $adsUpdate= $this->_serializer->deserialize($data,'App\Entity\Ads', 'json');
            $ads = $this->_adsService->updateAds($adsUpdate, $adsinitiale);

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse("Ads modified", Response::HTTP_ACCEPTED);

        }else{
            return new JsonResponse("no allowed", Response::HTTP_FORBIDDEN);

        }

    }

    /**
     * @Route("/api/ads/deleted/{id}/",  requirements={"id"="\d+"},  name="api_ads_deleted", methods={"PATCH"})
     */
    public function deletedAds(Request $request)
    {
        $id = $request->get('id');
        $user = $this->_checkUserService->getUserByToken($request);
        $ads = $this->_adsRepository->find($id);

        if (empty($ads)){
            return new JsonResponse("ads no exist", Response::HTTP_NOT_FOUND);
        }

        if(empty($user))
        {
            return new JsonResponse("user no exist", Response::HTTP_NOT_FOUND);
        }elseif ($this->_checkUserService->isAdmin($user) or $user == $ads->getUser()){
            $em = $this->getDoctrine()->getManager();
            $em->remove($ads);
            $em->flush();
        }

        return new JsonResponse("deleted success", Response::HTTP_ACCEPTED);

    }
}
