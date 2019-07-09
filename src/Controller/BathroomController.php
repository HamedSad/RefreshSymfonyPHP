<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BathroomRepository;
use App\Repository\Product\PaintRepository;
use App\Repository\Product\BathtubRepository;
use App\Repository\Product\ShowerRepository;
use App\Repository\Product\SinkRepository;
use App\Repository\Product\ToiletsRepository;
use App\Form\BathroomType;
use App\Entity\Bathroom;
use Doctrine\Common\Persistence\ObjectManager;


class BathroomController extends AbstractController{

    public function __construct(BathroomRepository $repository, PaintRepository $paintRepo, 
        BathtubRepository $bathtubRepo, ShowerRepository $showerRepo, SinkRepository $sinkRepo, 
        ToiletsRepository $toiletsRepo, ObjectManager $em){
            $this->repository = $repository;
            $this->paintRepo = $paintRepo;
            $this->bathtubRepo = $bathtubRepo;
            $this->showerRepo = $showerRepo;
            $this->sinkRepo = $sinkRepo;
            $this->toiletsRepo = $toiletsRepo;
            $this->em = $em;
    }

    /**
    *@Route("/mesProjetsSDB/{slug}-{id}", name="projectBath.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id) : Response{

        $project =$this->repository->find($id);
        $productPaint = $this->paintRepo->findAllVisiblePaint();
        $productBathtub = $this->bathtubRepo->findAllVisibleBathtub();
        $productShower = $this->showerRepo->findAllVisibleShower();
        $productSink = $this->sinkRepo->findAllVisibleSink();
        $productToilets = $this->toiletsRepo->findAllVisibleToilets();

        return $this->render('projects/showSDB.index.html.twig',[
            'project' => $project,
            'current_menu' => 'projects',
            'productPaint'=>$productPaint,
            'productBathtub'=>$productBathtub,
            'productShower'=>$productShower,
            'productSink'=>$productSink,
            'productToilets'=>$productToilets
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

}