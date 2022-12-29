<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Client
 *
 * @ORM\Table(name="client", uniqueConstraints={@ORM\UniqueConstraint(name="num", columns={"num"}), @ORM\UniqueConstraint(name="username", columns={"username"}),  @ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class Client implements UserInterface
{
    /**
     * @var int
     * @Groups ("post:read")

     * @ORM\Column(name="idCl", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcl;


    /**
     *      @Groups ("post:read")

     * @var string
     * @ORM\Column(name="username", type="string", length=255, nullable=false)


     */
    private $username;
    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255, nullable=false)

     * @Groups ("post:read")

     */
    private $password;

    /**
     * @var string
    @Assert\Length(
     * min = 2,
     * max = 20,
     * minMessage = "le nom doit contenir au moins 2 caract`eres",
     * maxMessage = "le nom doit contenir au plus 20 caract`eres",
     * allowEmptyString = false
     * )
     * @Assert\Type(
     * type={"alpha", "digit"},
     * message="le nom doit contenir seulement des lettres alphabétiques")
     * @Assert\NotBlank(message="Veuillez saisir le nom")
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * @Groups ("post:read")

     */
    private $nom;

    /**
     * @var string
     * @Assert\Length(
     * min = 2,
     * max = 20,
     * minMessage = "le prenom doit contenir au moins 2 caract`eres",
     * maxMessage = "le prenom doit contenir au plus 20 caract`eres",
     * allowEmptyString = false
     * )
     * @Assert\Type(
     * type={"alpha", "digit"},
     * message="le prenom doit contenir seulement des lettres alphabétiques")
     * @Assert\NotBlank(message="Veuillez saisir le prenom")
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     * @Groups ("post:read")

     */
    private $prenom;

    /**
     * @var string
     * @Assert\Email(message="Adresse email invalide")
     * @Assert\NotBlank(message="Veuillez saisir une adresse email")
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Groups ("post:read")

     */
    private $email;

    /**

     * @var int
     * @Assert\NotBlank(message="Veuillez saisir le numero de telephone")
     * @ORM\Column(name="num", type="integer", nullable=false)
     * @Groups ("post:read")

     */
    private $num;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="date", nullable=true)
     * @Groups ("post:read")

     */
    private $datecreation;



    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez préciser si le payement a été effectué ou non")
     * @Groups ("post:read")

     * @ORM\Column(name="paye", type="string", length=20, nullable=false)
     */
    private $paye;

    /**
     * @var string|null
     * @Groups ("post:read")

     * @ORM\Column(name="Image", type="string", length=255, nullable=true, options={"default"="http://localhost/project/user.png"})
     */
    private $image ;
    /**
     * Client constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdcl(): ?int
    {
        return $this->idcl;
    }


    /**
     * @param int $idcl
     * @return Client
     */
    public function setIdcl(int $idcl): Client
    {
        $this->idcl = $idcl;
        return $this;
    }






    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Client
     */
    public function setNom(string $nom): Client
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Client
     */
    public function setPrenom(string $prenom): Client
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Client
     */
    public function setEmail(string $email): Client
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getNum(): ?int
    {
        return $this->num;
    }

    /**
     * @param int $num
     * @return Client
     */
    public function setNum(int $num): Client
    {
        $this->num = $num;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatecreation()

    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime|null $datecreation
     */
    public function setDatecreation( $datecreation)
    {
        $this->datecreation = $datecreation;
        return $this;
    }



    /**
     * @return string
     */
    public function getPaye(): ?string
    {
        return $this->paye;
    }

    /**
     * @param string $paye
     * @return Client
     */
    public function setPaye(string $paye): Client
    {
        $this->paye = $paye;
        return $this;
    }


    public function getRoles()
    {
        return [
            'ROLE_USER'
        ];    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getSalt()
    {
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function eraseCredentials()
    {
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    /**
     * @var int|null
     *
     * @ORM\Column(name="Auth", type="integer", nullable=true)

     */
    private $auth;
    /**
     * @return int|null
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param int|null $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }
    /**
     * @var int|null
     *
     * @ORM\Column(name="Code", type="integer", nullable=true)
     */
    private $code;
    /**
     * @return int|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int|null $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }


}

