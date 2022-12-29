<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idCm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcm;

    /**
     * @var string
     * @Groups ("post:read")

     * @ORM\Column(name="comm", type="string", length=255, nullable=false)
     */
    private $comm;



    /**
     * @return int
     */
    public function getIdcm(): int
    {
        return $this->idcm;
    }

    /**
     * @param int $idcm
     * @return Commentaire
     */
    public function setIdcm(int $idcm): Commentaire
    {
        $this->idcm = $idcm;
        return $this;
    }

    /**
     * @return string
     */
    public function getComm(): string
    {
        return $this->comm;
    }

    /**
     * @param string $comm
     * @return Commentaire
     */
    public function setComm(string $comm): Commentaire
    {
        $this->comm = $comm;
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
     * @return Commentaire
     */
    public function setDatepost(\DateTime $datepost): Commentaire
    {
        $this->datepost = $datepost;
        return $this;
    }

}
