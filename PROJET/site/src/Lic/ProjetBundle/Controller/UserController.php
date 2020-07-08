<?php

namespace Lic\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lic\ProjetBundle\Entity\Panier;
use Lic\ProjetBundle\Entity\Utilisateurs;
use \DateTime;

/*
 * Auteurs : ROUIL Gaëtan, RACAPE Tristan
 */
class UserController extends Controller
{
    public function magasinAction()
    {
        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);
        $ProduitsRepository = $em->getRepository('LicProjetBundle:Produits');

        $produits = $ProduitsRepository->findAll();


        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $isadmin=$user->getIsadmin();
            if($isadmin){
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
            else{
                return $this->render('LicProjetBundle:User:magasin.html.twig', array('produits'=>$produits));
            }
        }


    }

    public function panierAction()
    {
        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');
        $produitRepository = $em->getRepository('LicProjetBundle:Produits');

        $user = $UtilisateursRepository->find($iduser);

        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $isadmin=$user->getIsadmin();
            if($isadmin){
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
            else{
                $panierRepository = $em->getRepository('LicProjetBundle:Panier');
                $prix =0;

                foreach ($_POST as $idProduit => $qte)
                {
                    $oldQte =0;

                    if ($qte !=0) {
                        $produit = $produitRepository->find($idProduit);

                        $tabpanier = $panierRepository->findBy(array('client'=>$iduser));
                        foreach($tabpanier as $unpanier){
                            if($idProduit==$unpanier->getProduits()->getId()){
                                $oldQte=$unpanier->getQuantite_com();
                                $em->remove($unpanier);
                            }
                        }


                        $panier = new Panier();
                        $panier->setProduits($produit);
                        $panier->setClient($user);
                        $panier->setQuantite_com($qte+$oldQte);

                        $produit->setQuantite($produit->getQuantite()-$qte);

                        $prix+=$panier->getProduits()->getPrix()*$panier->getQuantite_com();

                        $em->persist($panier);
                    }
                }
                $em->flush();
                $tabpanier = $panierRepository->findBy(array('client'=>$iduser));
                return $this->render('LicProjetBundle:User:panier.html.twig', array('panier'=>$tabpanier,'prix'=>$prix));
            }
        }

    }

    public function deleteAction($id)
    {

        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);

        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $isadmin=$user->getIsadmin();
            if($isadmin){
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
            else{
                $panierRepository = $em->getRepository('LicProjetBundle:Panier');
                $produitRepository= $em->getRepository('LicProjetBundle:Produits');
                $panier =  $panierRepository->find($id);


                $qte=$panier->getQuantite_com();

                $idProduit=$panier->getProduits();

                $produits= $produitRepository->find($idProduit);

                $produits->setQuantite($qte+$produits->getQuantite());


                $em->remove($panier);

                $em->flush();

                return $this->redirectToRoute('lic_projet_User_panier');
            }
        }

    }

    public function commanderAction()
    {
        $iduser=$this->container->getParameter('user');
        $em = $this->getDoctrine()->getEntityManager();


        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);


        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');
        }
        else{
            $isadmin=$user->getIsadmin();
            if($isadmin){
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
            else{
                $panierRepository = $em->getRepository('LicProjetBundle:Panier');
                $tabpanier = $panierRepository->findBy(array('client'=>$iduser));

                foreach($tabpanier as $panier) {
                    if ($panier != null) {
                        $em->remove($panier);
                    }
                }
                $em->flush();
                return $this->redirectToRoute('lic_projet_User_panier');
            }
        }
}


    public function viderAction()
    {
        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);
        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $isadmin=$user->getIsadmin();
            if($isadmin){
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
            else{
                $panierRepository = $em->getRepository('LicProjetBundle:Panier');
                $tabpanier = $panierRepository->findBy(array('client' => $iduser));
                $ProduitsRepository = $em->getRepository('LicProjetBundle:Produits');
                $produits = $ProduitsRepository->findAll();

                foreach ($produits as $prod) {
                    foreach ($tabpanier as $panier) {
                        if ($panier != null) {
                            if ($panier->getProduits()->getId() == $prod->getId()) {
                                $prod->setQuantite($prod->getQuantite()+$panier->getQuantite_com());
                            }
                            $em->remove($panier);
                        } else {
                            /* afficher un message d'erreur "panier vide"*/
                        }

                    }
                }

                $em->flush();

                return $this->redirectToRoute('lic_projet_User_panier');
            }
        }

    }

    public function formEditAccountAction()
    {
        $anniversaire= new DateTime();

        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);

        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $birthday = $user->getAnniversaire();
            if($birthday!=null){
                $anniv= $birthday->format('d-m-Y');
            }
            else{
                $anniv=$anniversaire->format('d-m-Y');
            }

            return $this->render('LicProjetBundle:User:formEditAccount.html.twig',array('user'=>$user,
                'anniversaire'=>$anniv));

        }


    }

    public function testEditAccountAction()
    {

        $iduser=$this->container->getParameter('user');
        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');
        $user = $UtilisateursRepository->find($iduser);
        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $date= new DateTime();
            $birthday= new DateTime($_POST['user_birthday']);

            $user->setIdentifiant($_POST['user_identifiant']);
            $user->setMotdepasse($_POST['user_password']);
            $user->setNom($_POST['user_name']);
            $user->setPrenom($_POST['user_firstname']);
            $user->setAnniversaire($birthday);
            $user->setModified($date);

            $em->persist($user);
            $em->flush();
            dump($user);

            return $this->render('LicProjetBundle:Default:home.html.twig');
        }

    }
}
