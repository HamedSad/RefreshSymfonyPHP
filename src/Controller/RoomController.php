<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoomRepository;
use App\Entity\Room;
use App\Form\RoomType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ProductRepository;

//Création de ma classe RoomController
class RoomController extends AbstractController{

/**
*@var RoomRepository
*
*/
private $repository;

//injection de dépendance pour le lier avec le repository
public function __construct(RoomRepository $repository, ProductRepository $productRepository,
ObjectManager $em){
    $this->repository = $repository;
    $this->productRepository = $productRepository;
    $this->em = $em;
}

//mise en place de la route et de son nom
/**
*@Route("/mesProjetsRoom/{slug}-{id}", name="projectRoom.show", requirements={"slug": "[a-z0-9\-]*"})
*@return Response
*/
public function show($slug, $id) : Response{

    $project =$this->repository->find($id);
    $products = $this->productRepository->findAllVisible();
    return $this->render('projects/showRoom.index.html.twig',[
        'project' => $project,
        'current_menu' => 'projects',
        'products' => $products
    ]);

    }

    /**
    *@Route("/projetChambre/nouveau", name="projectRoom.new", methods="GET|POST")
    */
    public function new(Request $request){
        $projectRoom = new Room();
        $form = $this->createForm(RoomType::class, $projectRoom);
        $form->handleRequest($request);
        if($form->isSubmitted()  && $form->isValid()){
            $this->em->persist($projectRoom);   
            $this->em->flush();
            $this->addFlash('success', 'Votre projet chambre a bien été créé');
            return $this->redirectToRoute('projects.index');
        }
        return $this->render('projects/newProjectRoom.html.twig', [
            //On envoie le tout à la vue
            'project'=> $projectRoom,
            'form'=>$form->createView()
            ]); 
    }

    /**
    *@Route("/mesProjetsChambre/modification/{id}", name="projectRoom.edit")
    *@param Room $project
    *@param Request $request
    *@return Response
    */
    public function edit(Room $project, Request $request){
        //methode create form pour utiliser le formulaire avec le nom du formulaire et la mon entité qui comprendra toutes mes variables
        $form = $this->createForm(RoomType::class, $project);

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
        return $this->render('projects/editProjectRoom.html.twig', [
            //On envoie le tout à la vue
            'project'=> $project,
            'form'=>$form->createView()
            ]);     
    }

    /**
    *@Route("/mesProjectChambre/suppression/{id}", name="projectRoom.delete", methods="DELETE")
    *@param Room $room
    *@return Response
    */
    public function delete(Room $room, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            $this->em->remove($room);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Votre projet a bien été supprimé');
            //return new Response('Suppression');
            }
            
            return $this->redirectToRoute('projects.index');
    }
}