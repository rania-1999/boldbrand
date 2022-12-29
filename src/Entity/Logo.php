<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Logo
 *
 * @ORM\Table(name="logo")
 * @ORM\Entity
 */
class Logo
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idLg", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlg;

    /**
     * @var string
     * @Groups ("post:read")

     * @ORM\Column(name="imgLg", type="string", length=255, nullable=false)
     */
    private $imglg;

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
      *  @ORM\JoinColumn(name="idClient", referencedColumnName="idCl")
    * })
     */
    private $client;

    /**
     * @return int
     */
    public function getIdlg(): ?int
    {
        return $this->idlg;
    }

    /**
     * @param int $idlg
     * @return Logo
     */
    public function setIdlg(int $idlg): Logo
    {
        $this->idlg = $idlg;
        return $this;
    }

    /**
     * @return string
     */
    public function getImglg(): ?string
    {
        return $this->imglg;
    }

    /**
     * @param string $imglg
     * @return Logo
     */
    public function setImglg(string $imglg): Logo
    {
        $this->imglg = $imglg;
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
     * @return Logo
     */
    public function setDatecreation(\DateTime $datecreation): Logo
    {
        $this->datecreation = $datecreation;
        return $this;
    }

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
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="logo", orphanRemoval=true)
     */
    private $commentaires;


    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setLogos($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getLogos()=== $this) {
                $commentaire->setLogos(null);
            }
        }

        return $this;
    }
}
