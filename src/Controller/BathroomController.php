<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BathroomRepository;
use App\Form\BathroomType;
use App\Entity\Bathroom;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ProductRepository;

class BathroomController extends AbstractController{

    public function __construct(BathroomRepository $repository, ProductRepository $productRepository, 
         ObjectManager $em){
            $this->repository = $repository;
            $this->productRepository = $productRepository;
            $this->em = $em;
    }

    /**
    *@Route("/mesProjetsSDB/{slug}-{id}", name="projectBath.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id) : Response{

        $project =$this->repository->find($id);
        $products = $this->productRepository->findAllVisible();

        return $this->render('projects/showSDB.index.html.twig',[
            'project' => $project,
            'current_menu' => 'projects',
            'products' => $products
        ]);

    }

    /**
    *@Route("/projetSalleDeBain/nouveau", name="projectBathroom.new", methods="GET|POST")
    */
    public function new(Request $request){
        $projectBathroom = new Bathroom();
        $form = $this->createForm(BathroomType::class, $projectBathroom);
        $form->handleRequest($request);
        if($form->isSubmitted()  && $form->isValid()){
            $this->em->persist($projectBathroom);   
            $this->em->flush();
            $this->addFlash('success', 'Votre projet salle de bain a bien été créé');
            return $this->redirectToRoute('projects.index');
        }
        return $this->render('projects/newProjectBathroom.html.twig', [
            //On envoie le tout à la vue
            'project'=> $projectBathroom,
            'form'=>$form->createView()
            ]); 
    }

    /**
    *@Route("/mesProjetsSDB/modification/{id}", name="projectBathroom.edit")
    *@param Bathroom $project
    *@param Request $request
    *@return Response
    */
    public function edit(Bathroom $project, Request $request){
        //methode create form pour utiliser le formulaire avec le nom du formulaire et la mon entité qui comprendra toutes mes variables
        $form = $this->createForm(BathroomType::class, $project);

        //utilisation de la methode handleRequest issue de la class Request
        $form->handleRequest($request);

        //le formulaire a t il été envoyé et est-il valide?
        if($form->isSubmitted()  && $form->isValid()){
            //Si les données sont valides il va mettre à jour la BDD
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Votre projet a bien été modifié');
            //redirection de l'user vers admine.project.index
            return $this->redirectToRoute('projects.index');
        }

        //puis je lui dis de se rendre sur la page admin/project/edit.html
        return $this->render('projects/editProjectBathroom.html.twig', [
            //On envoie le tout à la vue
            'project'=> $project,
            'form'=>$form->createView()
            ]);     
    }

    /**
    *@Route("/mesProjectSDB/suppression/{id}", name="projectBathroom.delete", methods="DELETE")
    *@param Bathroom $bathroom
    *@return Response
    */
    public function delete(Bathroom $bathroom, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            $this->em->remove($bathroom);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Votre projet a bien été supprimé');
            }
            
            return $this->redirectToRoute('projects.index');
    }
}