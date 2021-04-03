<?php

namespace App\Controller\Api;

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
 * Class BaseController
 * @package App\Controller\Api
 */
class BaseController extends AbstractController
{
    const TOTAL_RESULTS_PER_PAGE = 9;



}