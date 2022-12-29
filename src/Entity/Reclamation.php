<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idRec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrec;

    /**
     * @var string
     * @Groups ("post:read")
     * @Assert\NotBlank(message="Veuillez ecrire un objet")

     * @ORM\Column(name="obj", type="string", length=255, nullable=false)
     */
    private $obj;

    /**
     * @var string
     * @Groups ("post:read")
     * @Assert\NotBlank(message="Veuillez veuillez ecrire un message")

     * @ORM\Column(name="msg", type="string", length=255, nullable=false)
     */
    private $msg;
    /**
     * @var string
     * @Groups ("post:read")

     * @ORM\Column(name="response", type="string", length=1200, nullable=false)
     */
    private $response;
    /**
     * @var Client
     * @Groups ("post:read")

     * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idclient", referencedColumnName="idCl")
     * })
     */
    private $client;
    /**
     * @return Client
     */
    public function getClient(): ?Client
    {
return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client=$client;
    }
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date", nullable=false)
     */
    private $datecreation;

    /**
     * @return int
     */
    public function getIdrec(): int
    {
        return $this->idrec;
    }

    /**
     * @param int $idrec
     * @return Reclamation
     */
    public function setIdrec(int $idrec): Reclamation
    {
        $this->idrec = $idrec;
        return $this;
    }

    /**
     * @return string
     */
    public function getObj(): ?string
    {
        return $this->obj;
    }

    /**
     * @param string $obj
     * @return Reclamation
     */
    public function setObj(string $obj): Reclamation
    {
        $this->obj = $obj;
        return $this;
    }

    /**
     * @return string
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }

    /**
     * @param string $msg
     * @return Reclamation
     */
    public function setMsg(string $msg): Reclamation
    {
        $this->msg = $msg;
        return $this;
    }



    /**
     * @return \DateTime
     */
    public function getDatecreation(): ?\DateTime
    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime $datecreation
     * @return Reclamation
     */
    public function setDatecreation(\DateTime $datecreation): Reclamation
    {
        $this->datecreation = $datecreation;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponse(): ?string
    {
        return $this->response;
    }

    /**
     * @param string $response
     * @return Reclamation
     */
    public function setResponse(string $response): Reclamation
    {
        $this->response = $response;
        return $this;
    }


}
