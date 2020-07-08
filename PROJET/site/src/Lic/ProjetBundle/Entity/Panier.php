<?php

namespace Lic\ProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="l31819_panier")
 * @ORM\Entity(repositoryClass="Lic\ProjetBundle\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Utilisateurs
     * @ORM\ManyToOne(targetEntity="Lic\ProjetBundle\Entity\Utilisateurs")
     * @ORM\JoinColumn(name="id_utilisateurs", nullable=false)
     */
    private $client;

    /**
     * @var Produits
     *
     * @ORM\ManyToOne(targetEntity="Lic\ProjetBundle\Entity\Produits")
     * @ORM\JoinColumn(name="id_produits", nullable=false)
     */
    private $produits;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_com", type="integer")
     */
    private $quantite;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param \Lic\ProjetBundle\Entity\Utilisateurs $client
     *
     * @return Panier
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Lic\ProjetBundle\Entity\Utilisateurs
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set Produits
     *
     * @param \Lic\ProjetBundle\Entity\Produits $produits
     *
     * @return Panier
     */
    public function setProduits($produits)
    {
        $this->produits = $produits;

        return $this;
    }

    /**
     * Get produits
     *
     * @return \Lic\ProjetBundle\Entity\Produits
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set quantite_com
     *
     * @param int $quantite
     *
     * @return Panier
     */
    public function setQuantite_com($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite_com
     *
     * @return int
     */
    public function getQuantite_com()
    {
        return $this->quantite;
    }
}

