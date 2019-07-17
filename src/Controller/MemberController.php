<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\MemberType;
use App\Entity\Member;
use App\Repository\MemberRepository;

class MemberController extends AbstractController{

    public function __construct(MemberRepository $memberRepo, ObjectManager $em){
        $this->memberRepo = $memberRepo;
        $this->em = $em;
    }


    /**
     * @Route("/", name="member.new")
     */
    public function newMember(Request $request){
        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($form);
            $this->em->flush();
            $this->em->addFlash('success', 'Votre inscription a bien été enregistrée');
            return $this->redirectToRoute('projets.index');
        }
        return $this->render('member/inscription.html.twig', [
            'member'=>$member,
            'form'=>$form->createView()
        ]);
    }

    

    /**
     * @Route("/loginMember", name="member.login", methods="GET|POST")
     */
    public function loginMember(AuthenticationUtils $authenticationUtils)
    {
        //methode getLastAuthenticationError pour récupérer les erreurs
        $error = $authenticationUtils->getLastAuthenticationError();

        //methode getLastUsername qui permet de récupérer le dernier username entré par l'user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('member/login.html.twig', [
            //on va envoyer à la vue tout se qui s'appelle last_username sera égal
            // à ma variable $lastUsername
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}