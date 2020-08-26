<?php

namespace App\Controller\Api;

use App\Repository\AdsRepository;
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
class AdsController extends AbstractController implements RequiredMethods
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
     * @param AdsRepository $adsRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(AdsRepository $adsRepository, SerializerInterface $serializer, RequestStack $requestStack)
    {
        $this->_adsRepository = $adsRepository;
        $this->_serializer = $serializer;
    }

    /**
     * @Route("/api/ads/", name="api_ads")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $listAds = $this->_adsRepository->findAll();
        $data = $this->_serializer->serialize($listAds, 'json', SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/ads/create", name="api_ads_create")
     * @Method({"PUT"},{"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        //dump($data);die;
        //if ( $this->get('validator')->validate($data) ) {
        $ads = $this->_serializer->deserialize($data, 'App\Entity\Ads', 'json');


        $em = $this->getDoctrine()->getManager();
        $em->persist($ads);
        $em->flush();
        //}


        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/ads/{id}/", name="api_ads_id")
     * @Method({"GET"})
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
     * @Route("/api/ads/{id}/", name="api_ads_update")
     * @Method({"PATCH"})
     */
    public function updateAction(Request $request)
    {
        $id = $request->get('id');
        $data = $request->getContent();

        $adsUpdate= $this->_serializer->deserialize($data,'App\Entity\Ads', 'json');
        $adsOrigine = $this->_adsRepository->find($id);
        
    }













}
