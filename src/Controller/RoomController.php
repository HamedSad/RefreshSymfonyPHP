<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoomRepository;
use App\Repository\Product\PaintRepository;
use App\Entity\Room;
use App\Form\RoomType;
use Doctrine\Common\Persistence\ObjectManager;

//Création de ma classe RoomController
class RoomController extends AbstractController{

//injection de dépendance pour le lier avec le repository
public function __construct(RoomRepository $repository, PaintRepository $paintRepo, 
ObjectManager $em){
    $this->repository = $repository;
    $this->paintRepo = $paintRepo;
    $this->em = $em;
}

//mise en place de la route et de son nom
/**
*@Route("/mesProjetsRoom/{slug}-{id}", name="projectRoom.show", requirements={"slug": "[a-z0-9\-]*"})
*@return Response
*/
public function show($slug, $id) : Response{

    $project =$this->repository->find($id);
    $productPaint = $this->paintRepo->findAllVisiblePaint();
    
    return $this->render('projects/showRoom.index.html.twig',[
        'project' => $project,
        'current_menu' => 'projects',
        'productPaint'=>$productPaint,
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

}