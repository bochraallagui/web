<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?int $idReponse = null;

   #[ORM\Column( length:255)]
    
   #[Assert\NotBlank(message:"message reponse is required")]
    private ?string $messageRep = null;


      #[ORM\Column(length:255)]
     
    private ?string $etat = null;

     #[ORM\ManyToOne(inversedBy: 'reponses')]
     
    private ?User $fkIdAdmin = null;
    #[ORM\ManyToOne(inversedBy: 'reponses')]
    
#[ORM\JoinColumn(name: "fk_id_reclamation", referencedColumnName: "id_rec")]
private ?Reclamation $fkIdReclamation = null;



    public function getIdReponse(): ?int
    {
        return $this->idReponse;
    }

    public function getMessageRep(): ?string
    {
        return $this->messageRep;
    }

    public function setMessageRep(string $messageRep): self
    {
        $this->messageRep = $messageRep;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getFkIdAdmin(): ?User
    {
        return $this->fkIdAdmin;
    }

    public function setFkIdAdmin(?User $fkIdAdmin): self
    {
        $this->fkIdAdmin = $fkIdAdmin;

        return $this;
    }

    public function getFkIdReclamation(): ?Reclamation
    {
        return $this->fkIdReclamation;
    }

    public function setFkIdReclamation(?Reclamation $fkIdReclamation): self
    {
        $this->fkIdReclamation = $fkIdReclamation;

        return $this;
    }


}
