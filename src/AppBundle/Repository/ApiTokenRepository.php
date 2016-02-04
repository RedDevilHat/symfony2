<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 15:46
 */

namespace AppBundle\Repository;


use AppBundle\Entity\ApiToken;
use Doctrine\ORM\EntityRepository;
use SSPSoftware\ApiTokenBundle\Entity\ApiTokenInterface;
use SSPSoftware\ApiTokenBundle\Repository\ApiTokenRepositoryInterface;
use SSPSoftware\ApiTokenBundle\Service\Util\RandomStringGenerator;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiTokenRepository extends EntityRepository implements ApiTokenRepositoryInterface
{

    /**
     * @param UserInterface $user
     * @return ApiTokenInterface
     */
    public function createApiToken(UserInterface $user)
    {
        $token = new ApiToken();
        $token->setUser($user);
        $token->setApiKey(RandomStringGenerator::generate());
        $token->setExpiresAt(new \DateTime('+ 1 month'));
        $this->_em->persist($token);
        $this->_em->flush($token);
        return $token;
    }

    /**
     * @param string $apiKey
     * @return ApiTokenInterface|null
     */
    public function findNotExpiredApiTokenByApiKey($apiKey)
    {
        throw new \LogicException('Not implemented yet');
    }
}