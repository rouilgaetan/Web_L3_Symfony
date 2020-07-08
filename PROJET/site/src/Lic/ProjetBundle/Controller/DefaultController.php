<?php

namespace Lic\ProjetBundle\Controller;

use Lic\ProjetBundle\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \DateTime;

/*
 * Auteurs : ROUIL Gaëtan, RACAPE Tristan
 */

class DefaultController extends Controller
{
    public function homeAction()
    {
        return $this->render('LicProjetBundle:Default:home.html.twig');

    }

    public function formconnectionAction()
    {
        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);


        if($user==null){

            return $this->render('LicProjetBundle:Default:formconnection.html.twig');

        }
        else{
                return $this->render('LicProjetBundle:Default:home.html.twig');
        }

    }

    public function formNewAccountAction()
    {
        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');

        $user = $UtilisateursRepository->find($iduser);


        if($user==null){

            return $this->render('LicProjetBundle:Default:formNewAccount.html.twig');

        }
        else{
            return $this->render('LicProjetBundle:Default:home.html.twig');
        }

    }


    public function testNewAccountAction()
    {

        $iduser=$this->container->getParameter('user');

        $em = $this->getDoctrine()->getEntityManager();
        $UtilisateursRepository = $em->getRepository('LicProjetBundle:Utilisateurs');
        $user = $UtilisateursRepository->find($iduser);

        if($user==null){

            $utilisateur = $UtilisateursRepository->findAll();
            $exist=false;

            foreach($utilisateur as $util){
                if ($_POST['user_identifiant']==$util->getIdentifiant()){
                    $exist=true;
                }
            }

            if($exist) {
                return $this->render('LicProjetBundle:Default:formNewAccount.html.twig');
            }
            else{

                $em = $this->getDoctrine()->getEntityManager();
                $date= new DateTime();
                $birthday= new DateTime();
                $birthday->setDate($_POST['user_birthday_year'], $_POST['user_birthday_month'],
                    $_POST['user_birthday_day']);

                $newUser = new Utilisateurs();
                $newUser->setIdentifiant($_POST['user_identifiant']);
                $newUser->setMotdepasse(sha1($_POST['user_password']));
                $newUser->setNom($_POST['user_name']);
                $newUser->setPrenom($_POST['user_firstname']);
                $newUser->setAnniversaire($birthday);
                $newUser->setIsadmin(false);
                $newUser->setCreated($date);
                $newUser->setModified($date);

                $em->persist($newUser);
                $em->flush();
                dump($newUser);
                return $this->render('LicProjetBundle:Default:testNewAccount.html.twig');
            }

        }
        else{
            return $this->render('LicProjetBundle:Default:home.html.twig');
        }
    }
}
