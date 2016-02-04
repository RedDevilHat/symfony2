<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:27
 */

namespace SSPSoftware\ApiTokenBundle\Service\User;


use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Interface ApiKeyUserProviderInterface
 * @package SSPSoftware\ApiTokenBundle\Service\User
 */
interface ApiKeyUserProviderInterface extends UserProviderInterface
{
    /**
     * @param $apiKey
     * @return UserInterface
     */
    public function loadUserByApiKey($apiKey);
}