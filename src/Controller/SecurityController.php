<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{

    /**
     *@Route("/login", name="login")
     */
     //On injecte Authentication Utils pour gérer les erreurs d'identification
    public function login(AuthenticationUtils $authenticationUtils){
        //methode getLastAuthenticationError pour récupérer les erreurs
        $error = $authenticationUtils->getLastAuthenticationError();

        //methode getLastUsername qui permet de récupérer le dernier username entré par l'user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            //on va envoyer à la vue tout se qui s'appelle last_username sera égal
            // à ma variable $lastUsername
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

   
}