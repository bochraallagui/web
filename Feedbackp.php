<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedbackp
 *
 * @ORM\Table(name="feedbackp", indexes={@ORM\Index(name="fk_id_userP", columns={"fk_id_userP"}), @ORM\Index(name="fk_id_produit", columns={"fk_id_produit"})})
 * @ORM\Entity
 */
class Feedbackp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_feedbackP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFeedbackp;

    /**
     * @var bool
     *
     * @ORM\Column(name="favorisP", type="boolean", nullable=false)
     */
    private $favorisp;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_userP", referencedColumnName="id")
     * })
     */
    private $fkIdUserp;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_produit", referencedColumnName="id_produit")
     * })
     */
    private $fkIdProduit;

    public function getIdFeedbackp(): ?int
    {
        return $this->idFeedbackp;
    }

    public function isFavorisp(): ?bool
    {
        return $this->favorisp;
    }

    public function setFavorisp(bool $favorisp): self
    {
        $this->favorisp = $favorisp;

        return $this;
    }

    public function getFkIdUserp(): ?User
    {
        return $this->fkIdUserp;
    }

    public function setFkIdUserp(?User $fkIdUserp): self
    {
        $this->fkIdUserp = $fkIdUserp;

        return $this;
    }

    public function getFkIdProduit(): ?Produit
    {
        return $this->fkIdProduit;
    }

    public function setFkIdProduit(?Produit $fkIdProduit): self
    {
        $this->fkIdProduit = $fkIdProduit;

        return $this;
    }


}
