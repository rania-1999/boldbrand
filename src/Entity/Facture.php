<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idF", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idf;

    /**
     * @var string
     * @Groups ("post:read")

     * @ORM\Column(name="facture", type="string", length=255, nullable=false)
     */
    private $facture;

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
     * @return int
     */
    public function getIdf(): int
    {
        return $this->idf;
    }

    /**
     * @param int $idf
     * @return Facture
     */
    public function setIdf(int $idf): Facture
    {
        $this->idf = $idf;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacture(): string
    {
        return $this->facture;
    }

    /**
     * @param string $facture
     * @return Facture
     */
    public function setFacture(string $facture): Facture
    {
        $this->facture = $facture;
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
    public function getDatepost(): \DateTime
    {
        return $this->datepost;
    }

    /**
     * @param \DateTime $datepost
     * @return Facture
     */
    public function setDatepost(\DateTime $datepost): Facture
    {
        $this->datepost = $datepost;
        return $this;
    }
}
