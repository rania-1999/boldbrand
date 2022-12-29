<?php

namespace App\Entity;

use App\Form\ChartType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Chart
 *
 * @ORM\Table(name="chart")
 * @ORM\Entity
 */
class Chart
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idCh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idch;

    /**
     * @var string
     * @Groups ("post:read")

     * @ORM\Column(name="docCh", type="string", length=255, nullable=false)
     */
    private $docch;

    /**
     * @var \DateTime
     * @Groups ("post:read")

     * @ORM\Column(name="dateCreation", type="date", nullable=false)
     */
    private $datecreation;

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
    public function getIdch(): ?int
    {
        return $this->idch;
    }

    /**
     * @param int $idch
     * @return Chart
     */
    public function setIdch(int $idch): Chart
    {
        $this->idch = $idch;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocch(): ?string
    {
        return $this->docch;
    }

    /**
     * @param string $docch
     * @return Chart
     */
    public function setDocch(string $docch): Chart
    {
        $this->docch = $docch;
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
     * @return Chart
     */
    public function setDatecreation(\DateTime $datecreation): Chart
    {
        $this->datecreation = $datecreation;
        return $this;
    }


}
