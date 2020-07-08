<?php
/**
 * Created by PhpStorm.
 * User: grouil
 * Date: 02/04/2019
 * Time: 17:58
 */


namespace Lic\ProjetBundle\Controller;

use \Doctrine\ORM\EntityManager;
/*
 * Auteurs : ROUIL Gaëtan, RACAPE Tristan
 */
class MyService
{
    /**
     * nombre total de produit
     *
     * @param EntityManager
     * @return integer
     */

    public function nbTotalProduit($em){
        $ProduitsRepository = $em->getRepository('LicProjetBundle:Produits');

        $produits = $ProduitsRepository->findAll();

        return count($produits);
    }
}