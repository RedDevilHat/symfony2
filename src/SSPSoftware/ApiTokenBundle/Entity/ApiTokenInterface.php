<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 15:17
 */

namespace SSPSoftware\ApiTokenBundle\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface ApiTokenInterface
 * @package SSPSoftware\ApiTokenBundle\Entity
 */
interface ApiTokenInterface
{
    /**
     * @return string
     */
    public function getApiKey();

    /**
     * @param string $apiKey
     * @return mixed
     */
    public function setApiKey(string $apiKey);

    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function setUser(UserInterface $user);

    /**
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * @param \DateTime $dateTime
     * @return mixed
     */
    public function setExpiresAt(\DateTime $dateTime);
}