<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation", indexes={@ORM\Index(name="fk_id_produit", columns={"fk_id_produit"}), @ORM\Index(name="fk_id_commande", columns={"fk_id_commande"})})
 * @ORM\Entity
 */
class Affectation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_affectation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAffectation;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_produit", referencedColumnName="id_produit")
     * })
     */
    private $fkIdProduit;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_commande", referencedColumnName="id_commande")
     * })
     */
    private $fkIdCommande;


}
