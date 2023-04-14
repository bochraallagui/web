<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Livraison;
use App\Repository\PointderelaisRepository;

#[ORM\Entity(repositoryClass: PointderelaisRepository::class)]
class Pointderelais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idPointderelais=null;

    
    #[ORM\Column( length :255 )]
    private ?string $adressePointderelais=null;

    
    #[ORM\Column( length :255 )]
    private ?string $region=null;

    #[ORM\Column]
    private ?int $horaire=null;

    #[ORM\ManyToOne(inversedBy: 'pointderelaiss')]
    
    #[ORM\JoinColumn(name: "fk_id_livraisonp", referencedColumnName: "idLivraison")]
    private ?Livraison $fkIdLivraisonp = null;
  

    public function getIdPointderelais(): ?int
    {
        return $this->idPointderelais;
    }


    public function getAdressePointderelais(): ?string
    {
        return $this->adressePointderelais;
    }

    public function setAdressePointderelais(String $adressePointderelais): self
    {
        $this->adressePointderelais = $adressePointderelais;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->adressePointderelais;
    }

    public function setRegion(string $region): self
    {
        $this->region= $region;

        return $this;
    }

    public function getHoraire(): ?int
    {
        return $this->horaire;
    }

    public function setHoraire(int $horaire): self
    {
        $this->horaire= $horaire;

        return $this;
    }
    public function getFkIdLivraisonp(): ?Livraison
    {
        return $this->fkIdLivraisonp;
    }

    public function setFkIdLivraison(?User $fkIdLivraisonp): self
    {
        $this->fkIdLivraisonp= $fkIdLivraisonp;

        return $this;
    }

}
