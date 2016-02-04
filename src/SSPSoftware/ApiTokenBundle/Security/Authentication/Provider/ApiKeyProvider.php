<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:22
 */

namespace SSPSoftware\ApiTokenBundle\Security\Authentication\Provider;

use SSPSoftware\ApiTokenBundle\Security\Authentication\Token\ApiKeyUserToken;
use SSPSoftware\ApiTokenBundle\Service\User\ApiKeyUserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\ChainUserProvider;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyProvider
 * @package SSPSoftware\ApiTokenBundle\Security\Authentication\Provider
 */
class ApiKeyProvider implements AuthenticationProviderInterface
{
    /**
     * @var UserProviderInterface
     */
    protected $userProvider;

    /**
     * ApiKeyProvider constructor.
     * @param UserProviderInterface $userProvider
     */
    public function __construct(UserProviderInterface $userProvider)
    {
        $this->userProvider = $userProvider;
    }


    /**
     * Attempts to authenticate a TokenInterface object.
     *
     * @param TokenInterface $token The TokenInterface instance to authenticate
     *
     * @return TokenInterface An authenticated TokenInterface instance, never null
     *
     * @throws AuthenticationException if the authentication fails
     */
    public function authenticate(TokenInterface $token)
    {
        if ($this->userProvider instanceof ChainUserProvider) {
            foreach ($this->userProvider->getProviders() as $provider) {
                $result = $this->doAuth($provider, $token);
                if ($result !== false) {
                    return $result;
                }
            }
        } else {
            $result = $this->doAuth($this->userProvider, $token);
            if ($result !== false) {
                return $result;
            }
        }
    }

    /**
     * Checks whether this provider supports the given token.
     *
     * @param TokenInterface $token A TokenInterface instance
     *
     * @return bool true if the implementation supports the Token, false otherwise
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof ApiKeyUserToken;
    }

    /**
     * @param $provider
     * @param TokenInterface $token
     *
     * @return bool|ApiKeyUserToken
     * @throws AuthenticationException
     */
    private function doAuth($provider, TokenInterface $token)
    {
        if (!$provider instanceof ApiKeyUserProviderInterface) {
            return false;
        }

        /** @var UserInterface $user */
        $user = $provider->loadUserByApiKey($token->getCredentials());
        if ($user) {
            $authenticatedToken = new ApiKeyUserToken($user->getRoles());
            $authenticatedToken->setUser($user);

            return $authenticatedToken;
        }
        throw new AuthenticationException('The API Key authentication failed');
    }
}