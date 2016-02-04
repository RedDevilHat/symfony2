<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 15:45
 */

namespace AppBundle\Entity;


use SSPSoftware\ApiTokenBundle\Entity\ApiTokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ApiToken
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApiTokenRepository")
 * @ORM\Table(name="`api_token`", indexes={@ORM\Index(name="idx_api_token_api_key", columns={"api_key"})})
 *
 * @package AppBundle\Entity
 */
class ApiToken implements ApiTokenInterface
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="api_key", type="string", length=64)
     */
    private $apiKey;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @var \DateTime
     * @ORM\Column(name="expires_at", type="datetime")
     */
    private $expiresAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $apiKey
     * @return mixed
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param \DateTime $dateTime
     * @return mixed
     */
    public function setExpiresAt(\DateTime $dateTime)
    {
        $this->expiresAt = $dateTime;
    }
}