<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 15:26
 */

namespace SSPSoftware\ApiTokenBundle\Repository;


use SSPSoftware\ApiTokenBundle\Entity\ApiTokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface ApiTokenRepositoryInterface
 * @package SSPSoftware\ApiTokenBundle\Repository
 */
interface ApiTokenRepositoryInterface
{
    /**
     * @param UserInterface $user
     * @return ApiTokenInterface
     */
    public function createApiToken(UserInterface $user);

    /**
     * @param string $apiKey
     * @return ApiTokenInterface|null
     */
    public function findNotExpiredApiTokenByApiKey($apiKey);
}