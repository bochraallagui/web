<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointderelaisRepository::class)]
class Pointderelais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?int $idPointderelais = null;

    
      #[ORM\Column( length:255)]
     
    private ?string $adressePointderelais = null;

    public function getIdPointderelais(): ?int
    {
        return $this->idPointderelais;
    }

    public function getAdressePointderelais(): ?string
    {
        return $this->adressePointderelais;
    }

    public function setAdressePointderelais(string $adressePointderelais): self
    {
        $this->adressePointderelais = $adressePointderelais;

        return $this;
    }


}
