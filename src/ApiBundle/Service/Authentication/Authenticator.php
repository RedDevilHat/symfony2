<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 17:04
 */

namespace ApiBundle\Service\Authentication;


use AppBundle\Repository\ApiTokenRepository;
use AppBundle\Service\User\UserProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class Authenticator
{
    /**
     * @var UserProvider
     */
    private $userProvider;

    /**
     * @var ApiTokenRepository
     */
    private $apiTokenRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * Authenticator constructor.
     * @param UserProvider $userProvider
     * @param ApiTokenRepository $apiTokenRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        UserProvider $userProvider,
        ApiTokenRepository $apiTokenRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->userProvider = $userProvider;
        $this->apiTokenRepository = $apiTokenRepository;
        $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * @param $username
     * @param $password
     * @return \SSPSoftware\ApiTokenBundle\Entity\ApiTokenInterface
     */
    public function authenticate($username, $password)
    {
        $user = $this->userProvider->loadUserByUsername($username);
        if (!$this->passwordEncoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
            throw new AuthenticationException('Bad credentials');
        }

        return $this->apiTokenRepository->createApiToken($user);
    }
}