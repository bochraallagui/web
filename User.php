<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"users"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     * * * @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     *  * * @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     *  * * @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="date_naissance", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     * * @Assert\Date(
 *      message = "La date '{{ value }}' n'est pas une date valide."
 * )
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     * * @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel", type="integer", nullable=false)
     * * @Groups({"users"})
     * * * @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
 *  * @Assert\Length(
 *      exactMessage = "Votre numero doit contenir exactement {{ limit }} chiffres.",
 *      min = 8,
 *      max = 8,
 * )
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     * * * @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
 * * @Assert\Email(
 *      message = "L'email '{{ value }}' n'est pas valide."
 * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * * @Groups({"users"})
     ** @Assert\NotBlank(
 *      message = "Ce champ est requis."
 * )
 *  * @Assert\Length(

 *      minMessage = "Votre mot de passe doit contenir au moins {{ limit }} caractères.",
 * min = 8,
    
 * )
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function __toString()
    {
        
        $res=$this->getNom(). " ".  $this->getPrenom();
        return(string) $res;
    }


}
