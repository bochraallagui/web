<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pointderelais
 *
 * @ORM\Table(name="pointderelais", indexes={@ORM\Index(name="fk_id_livraisonp", columns={"fk_id_livraisonp"})})
 * @ORM\Entity
 */
class Pointderelais
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pointderelais", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPointderelais;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_pointderelais", type="string", length=255, nullable=false)
     */
    private $adressePointderelais;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=false)
     */
    private $region;

    /**
     * @var int
     *
     * @ORM\Column(name="horaire", type="integer", nullable=false)
     */
    private $horaire;

    /**
     * @var \Livraison
     *
     * @ORM\ManyToOne(targetEntity="Livraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_livraisonp", referencedColumnName="id_livraison")
     * })
     */
    private $fkIdLivraisonp;


}
