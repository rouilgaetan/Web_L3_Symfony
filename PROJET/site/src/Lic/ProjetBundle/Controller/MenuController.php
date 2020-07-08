<?php

namespace Lic\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/*
 * Auteurs : ROUIL Gaëtan, RACAPE Tristan
 */
class MenuController extends Controller
{
    public function menuAction()
    {
        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');
        $utilisateur = $UtilisateursRepository->find($iduser);
        $countProduits=$this->container->get('lic_projet.MyService');

        return $this->render('LicProjetBundle:Menu:menu.html.twig', array('user'=>$utilisateur,
            'compteur'=>$countProduits->nbTotalProduit($em)));

    }
}
