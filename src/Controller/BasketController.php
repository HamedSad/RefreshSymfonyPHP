<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\BasketRepository;
use App\Entity\Basket;

class BasketController extends AbstractController{

    public function __construct(BasketRepository $basketRepository, ObjectManager $objectManager )
    {
        $this->basketRepository = $basketRepository;
        $this->objectManager = $objectManager;
    }

    /**
     *@Route("/panier", name="basket.index", requirements={"slug": "[a-z0-9\-]*"})
     *@return Response
     */
    public function index() : Response {
        $products = $this->basketRepository->findAllVisible();

        return $this->render('basket.index.html.twig', [
            'products' => $products
        ]);
    }

    // /**
    // *@Route("/Panier/Ajouter", name="basket.add")
    // *@param Basketm $basket
    // *@param Request $request
    // *@return Response
    // */
    // public function edit(Basket $basket, Request $request){
    //     //methode create form pour utiliser le formulaire avec le nom du formulaire et la mon entité qui comprendra toutes mes variables
    //     $form = $this->createForm(BasketType::class, $basket);

    //     //utilisation de la methode handleRequest issue de la class Request
    //     $form->handleRequest($request);

    //     //le formulaire a t il été envoyé et est-il valide?
    //     if($form->isSubmitted()  && $form->isValid()){
    //         //Si les données sont valides il va mettre à jour la BDD
    //         $this->em->flush();
    //         //message de confirmation de création de projet 
    //         $this->addFlash('success', 'Le produit a bien été ajouté au panier');
    //         //redirection de l'user vers admine.project.index
    //         return $this->redirectToRoute('projects.index');
    //     }

    //     //puis je lui dis de se rendre sur la page admin/project/edit.html
    //     return $this->render('projects/editProjectBathroom.html.twig', [
    //         //On envoie le tout à la vue
    //         'project'=> $project,
    //         'form'=>$form->createView()
    //         ]);     
    // }

    /**
     * @Route("/panier/{id}", name="basket.delete", methods="DELETE")
     * @param Basket $basket
     * @return Response
     */
    public function delete(Request $request, Basket $basket){
         $submittedToken = $request->request->get('_token');
         //vérification de la valeur du token csrf pour le form suppression soit bien valide
         if ($this->isCsrfTokenValid('delete', $submittedToken)) {
             $this->objectManager->remove($basket);
             $this->objectManager->flush();
             //message de confirmation de création de projet 
             $this->addFlash('success', 'Le produit a bien été supprimé du panier');
            }
            
            return $this->redirectToRoute('basket.index');
    }

}