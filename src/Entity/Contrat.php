<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity
 */
class Contrat
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idCtr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idctr;

    /**
     * @var string
     * @Groups ("post:read")

     * @ORM\Column(name="docCtr", type="string", length=255, nullable=false)
     */
    private $docctr;

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
     * @var string
     *
     * @ORM\Column(name="docBonLiv", type="string", length=255, nullable=false)
     */
    private $docbonliv;

    /**
     * @return int
     */
    public function getIdctr(): ?int
    {
        return $this->idctr;
    }

    /**
     * @param int $idctr
     * @return Contrat
     */
    public function setIdctr(int $idctr): Contrat
    {
        $this->idctr = $idctr;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocctr(): ?string
    {
        return $this->docctr;
    }

    /**
     * @param string $docctr
     * @return Contrat
     */
    public function setDocctr(string $docctr): Contrat
    {
        $this->docctr = $docctr;
        return $this;
    }



    /**
     * @return string
     */
    public function getDocbonliv(): ?string
    {
        return $this->docbonliv;
    }

    /**
     * @param string $docbonliv
     * @return Contrat
     */
    public function setDocbonliv(string $docbonliv): Contrat
    {
        $this->docbonliv = $docbonliv;
        return $this;
    }
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $datepost;

    /**
     * @return \DateTime
     */
    public function getDatepost(): ?\DateTime
    {
        return $this->datepost;
    }

    /**
     * @param \DateTime $datepost
     * @return Contrat
     */
    public function setDatepost(\DateTime $datepost): Contrat
    {
        $this->datepost = $datepost;
        return $this;
    }

}
