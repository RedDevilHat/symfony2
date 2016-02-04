<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 16:15
 */

namespace AppBundle\Service\User;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use SSPSoftware\ApiTokenBundle\Repository\ApiTokenRepositoryInterface;
use SSPSoftware\ApiTokenBundle\Service\User\ApiKeyUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserProvider
 * @package AppBundle\Service\User
 */
class UserProvider implements ApiKeyUserProviderInterface
{

    /**
     * @var ApiTokenRepositoryInterface
     */
    private $apiTokenRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserProvider constructor.
     * @param ApiTokenRepositoryInterface $apiTokenRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ApiTokenRepositoryInterface $apiTokenRepository, UserRepository $userRepository)
    {
        $this->apiTokenRepository = $apiTokenRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * @param $apiKey
     * @return UserInterface
     */
    public function loadUserByApiKey($apiKey)
    {
        $token = $this->apiTokenRepository->findNotExpiredApiTokenByApiKey($apiKey);
        if ($token && $token->getUser()) {
            return $token->getUser();
        }

        return null;
    }

    /**
     * @param $username
     *
     * @return UserInterface
     * @throws UsernameNotFoundException
     */
    public function loadUserByUsername($username)
    {
        $user = $this->userRepository->findOneBy(['username' => $username]);
        if (!$user) {
            throw new UsernameNotFoundException(sprintf(
                'User with username: %s not found', $username
            ));
        }

        return $user;
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     * @throws UsernameNotFoundException
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === User::class || is_subclass_of($class, User::class);
    }
}