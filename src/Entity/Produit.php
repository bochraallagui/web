<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="type_paiement", type="string", length=255, nullable=false)
     */
    private $typePaiement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_produit", type="string", length=255, nullable=false)
     */
    private $typeProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="description_produit", type="string", length=255, nullable=false)
     */
    private $descriptionProduit;


}
