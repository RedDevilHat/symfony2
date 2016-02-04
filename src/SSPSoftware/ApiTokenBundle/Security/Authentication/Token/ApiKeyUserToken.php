<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:19
 */

namespace SSPSoftware\ApiTokenBundle\Security\Authentication\Token;


use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class ApiKeyUserToken
 * @package SSPSoftware\ApiTokenBundle\Security\Authentication\Token
 */
class ApiKeyUserToken extends AbstractToken
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * ApiKeyUserToken constructor.
     * @param array $roles
     */
    public function __construct(array $roles = [])
    {
        parent::__construct($roles);
        $this->setAuthenticated(count($roles) > 0);
    }


    /**
     * Returns the user credentials.
     *
     * @return mixed The user credentials
     */
    public function getCredentials()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return ApiKeyUserToken
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}