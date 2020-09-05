<?php

namespace App\Controller\Api\Vote;

use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Repository\AdsRepository;
use App\Repository\UserRepository;
use App\Repository\VotesRepository;
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
 * Class VoteController
 * @package App\Controller\Api\Vote
 */
class VoteController extends BaseController implements RequiredMethods
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
    private $_voteRepository;

    /**
     * UsersController constructor.
     * @param VoteRepository $voteRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(VotesRepository $voteRepository, SerializerInterface $serializer, RequestStack $requestStack)
    {
        $this->_voteRepository = $voteRepository;
        $this->_serializer = $serializer;
    }

    /**
     * @Route("/free-api/vote/", name="api_vote", methods={"GET"})
     */
    public function listAction(Request $request)
    {

        $page   = $request->query->get('page',1);
        $offset = ($page*self::TOTAL_RESULTS_PER_PAGE)-1;
        $listVotePaginator = $this->_voteRepository->getAll(self::TOTAL_RESULTS_PER_PAGE, $offset);

        $results['totalPage']    = $listVotePaginator->getNbPages();
        $results['totalResults'] = $listVotePaginator->getNbResults();
        $results['results']      = $listVotePaginator->getCurrentPageResults();

        $data = $this->_serializer->serialize($results, 'json', SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/free-api/vote/create", name="api_vote_create", methods={"POST","PUT"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        //dump($data);die;
        //if ( $this->get('validator')->validate($data) ) {
        $vote = $this->_serializer->deserialize($data, 'App\Entity\Votes', 'json');


        $em = $this->getDoctrine()->getManager();
        $em->persist($vote);
        $em->flush();
        //}


        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/free-api/vote/{id}/", requirements={"id"="\d+"}, name="api_vote_id", methods={"GET"})
     */
    public function getAction(Request $request)
    {
        $id = $request->get('id');
        $data = $this->_voteRepository->find($id);
        $response = new Response($this->_serializer->serialize($data, 'json', SerializationContext::create()->setGroups(array('get'))));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/vote/{id}/",  requirements={"id"="\d+"}, methods={"PATCH"})
     */
    public function updateAction(Request $request)
    {




    }













}
