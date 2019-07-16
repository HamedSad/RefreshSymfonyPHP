<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MemberRepository;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\InscriptionType;

class MemberController extends AbstractController{

    public function __construct(MemberRepository $memberRepo, ObjectManager $em){
        $this->memberRepo = $memberRepo;
        $this->em = $em;
    }

    /*
    *@Route("/member", name="member.new", methods="GET|POST")
    */
    public function inscription(Request $request){
        $member = new Member();
        $form = $this->createForm(InscriptionType::class, $member);
        $form->handleRequest($request);
        if($form->isSubmitted()  && $form->isValid()){
            $this->em->persist($member);   
            $this->em->flush();
            $this->addFlash('success', 'Votre profil utilisateur a bien été créé');
            return $this->redirectToRoute('member.login');
        }
        return $this->render('member/inscription.html.twig', [
            //On envoie le tout à la vue
            'member'=> $member,
            'form'=>$form->createView()
            ]); 
    }

    /**
     * @Route("/loginMember", name="member.login")
     */
    public function loginMember(AuthenticationUtils $authenticationUtils)
    {
        //methode getLastAuthenticationError pour récupérer les erreurs
        $error = $authenticationUtils->getLastAuthenticationError();

        //methode getLastUsername qui permet de récupérer le dernier username entré par l'user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('member/loginMember.html.twig', [
            //on va envoyer à la vue tout se qui s'appelle last_username sera égal
            // à ma variable $lastUsername
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}
