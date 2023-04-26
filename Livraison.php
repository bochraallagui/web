<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivraisonRepository;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idLivraison = null;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_livraison", type="date", nullable=false)
     */
    private $dateLivraison;

    
     #[ORM\Column]
    private ?float $prixLivraison = null;

    
      #[ORM\Column]
    private ?string $adresseLivraison = null;


    #[ORM\ManyToOne(inversedBy: 'livraisons')]
      private ?User $fkIdLivreur = null;
    

    public function getIdLivraison(): ?int
    {
        return $this->idLivraison;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getPrixLivraison(): ?float
    {
        return $this->prixLivraison;
    }

    public function setPrixLivraison(float $prixLivraison): self
    {
        $this->prixLivraison = $prixLivraison;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(string $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    public function getFkIdLivreur(): ?User
    {
        return $this->fkIdLivreur;
    }

    public function setFkIdLivreur(?User $fkIdLivreur): self
    {
        $this->fkIdLivreur = $fkIdLivreur;

        return $this;
    }


}