<?php

namespace Lic\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/*
 * Auteurs : ROUIL Gaëtan, RACAPE Tristan
 */
class AdminController extends Controller
{
    public function listeclientsAction()
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
                $utilisateur = $UtilisateursRepository->findall();
                return $this->render('LicProjetBundle:Admin:listeclients.html.twig', array('user'=>$utilisateur));
            }
            else{
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
        }
    }

    public function deleteAction($id)
    {

        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);
        $deleteUser =  $UtilisateursRepository->find($id);


        if($user==null){

            return $this->render('LicProjetBundle:Default:home.html.twig');

        }
        else{
            $isadmin=$user->getIsadmin();
            if($isadmin){
                $em->remove($deleteUser);

                $em->flush();

                return $this->redirectToRoute('lic_projet_Admin_listeclients');
            }
            else{
                return $this->render('LicProjetBundle:Default:home.html.twig');
            }
        }

    }
}
