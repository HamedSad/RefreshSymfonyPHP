<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoomRepository;
use App\Repository\BathroomRepository;
use App\Repository\Product\PaintRepository;
use App\Repository\Product\BathtubRepository;
use App\Repository\Product\ShowerRepository;
use App\Repository\Product\SinkRepository;
use App\Repository\Product\ToiletsRepository;

class ProjectController extends AbstractController{

    //injection de dépendance pour le lier avec le repository
public function __construct(RoomRepository $repository, BathroomRepository $repo, PaintRepository $paintRepo, 
BathtubRepository $bathtubRepo, ShowerRepository $showerRepo, SinkRepository $sinkRepo, ToiletsRepository $toiletsRepo)
{
    $this->repository = $repository;
    $this->repo = $repo;
    $this->paintRepo = $paintRepo;
    $this->bathtubRepo = $bathtubRepo;
    $this->showerRepo = $showerRepo;
    $this->sinkRepo = $sinkRepo;
    $this->toiletsRepo = $toiletsRepo;
}

/**
*
*@Route("/mesProjets", name="projects.index")
*@return Response
*/
public function index() : Response{
    $projectsRoom = $this->repository->findAllVisible();
    $projectsBathroom = $this->repo->findAllVisible();
    $productPaint = $this->paintRepo->findAllVisiblePaint();
    $productBathtub = $this->bathtubRepo->findAllVisibleBathtub();
    $productShower = $this->showerRepo->findAllVisibleShower();
    $productSink = $this->sinkRepo->findAllVisibleSink();
    $productToilets = $this->toiletsRepo->findAllVisibleToilets();

    return $this->render('projects/index.html.twig',[
        'current_menu' => 'projectsRoom',
        'projectsRoom' =>$projectsRoom,
        'projectsBathroom'=>$projectsBathroom,
        'productPaint'=>$productPaint,
        'productBathtub'=>$productBathtub,
        'productShower'=>$productShower,
        'productSink'=>$productSink,
        'productToilets'=>$productToilets
    ]);
}

// /**
// *@Route("/mesProjets/{slug}-{id}", name="project.show", requirements={"slug": "[a-z0-9\-]*"})
// *@return Response
// */
// public function show($slug, $id) : Response{

//     $project =$this->repository->find($id);

//     return $this->render('projects/show.index.html.twig',[
//         'project' => $project,
//         'current_menu' => 'projects'
//     ]);

// }

}