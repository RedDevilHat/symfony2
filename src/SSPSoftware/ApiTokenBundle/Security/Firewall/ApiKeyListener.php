<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:18
 */

namespace SSPSoftware\ApiTokenBundle\Security\Firewall;


use SSPSoftware\ApiTokenBundle\Security\Authentication\Token\ApiKeyUserToken;
use SSPSoftware\ApiTokenBundle\Service\KeyExtractor\KeyExtractorInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

/**
 * Class ApiKeyListener
 * @package SSPSoftware\ApiTokenBundle\Security\Firewall
 */
class ApiKeyListener implements ListenerInterface
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * @var KeyExtractorInterface
     */
    protected $keyExtractor;

    /**
     * ApiKeyListener constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param AuthenticationManagerInterface $authenticationManager
     * @param KeyExtractorInterface $keyExtractor
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthenticationManagerInterface $authenticationManager,
        KeyExtractorInterface $keyExtractor
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
        $this->keyExtractor = $keyExtractor;
    }


    /**
     * This interface must be implemented by firewall listeners.
     *
     * @param GetResponseEvent $event
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($this->keyExtractor->hasKey($request)) {
            $apiKey = $this->keyExtractor->extractKey($request);
            $token = new ApiKeyUserToken();
            $token->setApiKey($apiKey);

            try {
                $authToken = $this->authenticationManager->authenticate($token);
                $this->tokenStorage->setToken($authToken);

                return;
            } catch (AuthenticationException $e) {
                $token = $this->tokenStorage->getToken();
                if ($token instanceof ApiKeyUserToken && $token->getCredentials() === $apiKey) {
                    $this->tokenStorage->setToken(null);
                }
            }
        }
    }
}