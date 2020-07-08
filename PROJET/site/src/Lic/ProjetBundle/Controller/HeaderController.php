<?php

namespace Lic\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/*
 * Auteurs : ROUIL Gaëtan, RACAPE Tristan
 */
/*
 * Controlleur du header pour adapter le header à l'utilisateur.
 */
class HeaderController extends Controller
{
    public function headerAction()
    {
        $iduser=$this->container->getParameter('user');//Récupération de l'utilisateur connecté

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');


        $utilisateur = $UtilisateursRepository->find($iduser);

        return $this->render('LicProjetBundle:Header:header.html.twig', array('user'=>$utilisateur));

    }
}
