<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback", indexes={@ORM\Index(name="fk_id_user", columns={"fk_id_user"}), @ORM\Index(name="fk_id_service", columns={"fk_id_service"})})
 * @ORM\Entity
 */
class Feedback
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_feedback", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFeedback;

    /**
     * @var bool
     *
     * @ORM\Column(name="favoris", type="boolean", nullable=false)
     */
    private $favoris;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_service", referencedColumnName="id_service")
     * })
     */
    private $fkIdService;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_user", referencedColumnName="id")
     * })
     */
    private $fkIdUser;

    public function getIdFeedback(): ?int
    {
        return $this->idFeedback;
    }

    public function isFavoris(): ?bool
    {
        return $this->favoris;
    }

    public function setFavoris(bool $favoris): self
    {
        $this->favoris = $favoris;

        return $this;
    }

    public function getFkIdService(): ?Service
    {
        return $this->fkIdService;
    }

    public function setFkIdService(?Service $fkIdService): self
    {
        $this->fkIdService = $fkIdService;

        return $this;
    }

    public function getFkIdUser(): ?User
    {
        return $this->fkIdUser;
    }

    public function setFkIdUser(?User $fkIdUser): self
    {
        $this->fkIdUser = $fkIdUser;

        return $this;
    }


}
