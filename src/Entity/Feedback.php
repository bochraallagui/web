<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback", indexes={@ORM\Index(name="fk_id_produit", columns={"fk_id_produit"}), @ORM\Index(name="fk_id_userP", columns={"fk_id_userP"})})
 * @ORM\Entity
 */
class Feedback
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


}
