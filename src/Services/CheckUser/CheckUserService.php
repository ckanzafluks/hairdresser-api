<?php
namespace App\Services\CheckUser;

use App\Entity\Ads;
use App\Entity\CountVisiteurs;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\GroupeChat;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Test\Constraint\EmailAddressContains;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class CheckUserService
{
    private $_em;
    private $_userRepo;

    /**
     * CheckUserService constructor.
     */
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->_em       = $entityManager;
        $this->_userRepo = $userRepository;
    }

    public function getUserByToken(Request $request)
    {
        $token = $request->headers->get('Authorization');

        if(empty($token))
        {
            return new JsonResponse('token missing', Response::HTTP_FORBIDDEN);
        }
        $token_withoutBearer =mb_strimwidth($token, 7,strlen($token));

        return $this->_userRepo->loadUserByToken($token_withoutBearer);
    }

    public function isAdmin($user) /* @var $user \App\Entity\User */
    {
        $arrayRole = $user->getRoles();


        for ($i =0; $i< count($arrayRole);$i++)
        {
            if ($arrayRole[$i] == "ROLE_SUPER_ADMIN"){
                return true;
            }
        }

        return false;
    }
}

