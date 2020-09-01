<?php


namespace App\Controller\Api\ContactMessage;
use App\Controller\Api\BaseController;
use App\Controller\Api\RequiredMethods;
use App\Entity\ContractsMessages;
use App\Entity\User;
use App\Repository\AdsRepository;
use App\Repository\ContractsMessagesRepository;
use App\Repository\UserRepository;
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
 * Class MessageController
 * @package App\Controller\Api\ContactMessage
 */
class MessageController extends BaseController implements RequiredMethods
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
     * @var ContractsMessages
     */
    private $_messageRepository;

    /**
     * UsersController constructor.
     * @param ContractsMessagesRepository $messageRepository
     * @param SerializerInterface $serializer
     * @param RequestStack $requestStack
     */
    public function __construct(ContractsMessagesRepository $messageRepository, SerializerInterface $serializer, RequestStack $requestStack)
    {
        $this->_messageRepository = $messageRepository;
        $this->_serializer = $serializer;
    }

    /**
     * @Route("/api/message/sender/{idauter}", requirements={"id"="\d+"}, name="api_message_Send", methods={"GET"})
     */
    public function listMessageSendAction(Request $request)
    {
        /*@id
         * token must be used to identified user.
         ***************************/
        $id = $request->get('idauter');
        $user= $this->getDoctrine()->getRepository(User::class)->find($id);
        /*************************/

        if(!empty($user)) {

            $page = $request->query->get('page', 1);
            $offset = ($page * self::TOTAL_RESULTS_PER_PAGE) - 1;
            $listMessagePaginator = $this->_messageRepository->getAllMessageSend(self::TOTAL_RESULTS_PER_PAGE, $offset, $user);

            $results['totalPage'] = $listMessagePaginator->getNbPages();
            $results['totalResults'] = $listMessagePaginator->getNbResults();
            $results['results'] = $listMessagePaginator->getCurrentPageResults();

            $data = $this->_serializer->serialize($results, 'json', SerializationContext::create()->setGroups(array('list')));
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            return $response;

        }else{

            return new JsonResponse("user not exist", Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/api/message/receveid/{idauter}", requirements={"id"="\d+"}, name="api_message_Received", methods={"GET"})
     */
    public function listMessageReceivedAction(Request $request)
    {
        /*@id
       * token must be used to identified user.
       ***************************/
        $id = $request->get('idauter');
        $user= $this->getDoctrine()->getRepository(User::class)->find($id);
        /*************************/

        if(!empty($user)) {

            $page = $request->query->get('page', 1);
            $offset = ($page * self::TOTAL_RESULTS_PER_PAGE) - 1;
            $listMessagePaginator = $this->_messageRepository->getAllMessageReceveid(self::TOTAL_RESULTS_PER_PAGE, $offset, $user);

            $results['totalPage'] = $listMessagePaginator->getNbPages();
            $results['totalResults'] = $listMessagePaginator->getNbResults();
            $results['results'] = $listMessagePaginator->getCurrentPageResults();

            $data = $this->_serializer->serialize($results, 'json', SerializationContext::create()->setGroups(array('list')));
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            return $response;

        }else{

            return new JsonResponse("user not exist", Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/api/message/create", name="api_message_create", methods={"POST","PUT"})
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
     * @Route("/api/message/{id}/", requirements={"id"="\d+"}, name="api_message_id", methods={"GET"})
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
     * @Route("/api/message/{id}/",  requirements={"id"="\d+"}, methods={"PATCH"})
     */
    public function updateAction(Request $request)
    {
        $id = $request->get('id');
        $data = $request->getContent();

        $messageinitiale = $this->_messageRepository->find($id);
        if(empty($messageinitiale)){
            return new JsonResponse("Message not found", Response::HTTP_NOT_FOUND);
        }

        $messageUpdated = $this->_serializer->deserialize($data,'App\Entity\Contract', 'json');
        $messageinitiale->setDescription($messageUpdated->getDescription());

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new JsonResponse("Message modified", Response::HTTP_ACCEPTED);


    }
    /**
     * @Route("/api/message/deleted/{id}/",  requirements={"id"="\d+"}, name="api_message_deleted", methods={"DELETE"})
     */
    public function deleteMessageAction($id){
    /* Todo:
     * must add vérifcation user is allow to deleted message
     *
     * */

        $message = $this->getDoctrine()->getRepository(ContractsMessages::class)->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($message);
        $em->flush();

        return new JsonResponse("message is deleted.", Response::HTTP_OK);
    }

    public function listAction(Request $request)
    {
        // TODO: Implement listAction() method.
    }
}