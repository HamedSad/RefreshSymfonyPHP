<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoomRepository;
use App\Repository\BathroomRepository;
use App\Repository\ProductRepository;

class ProjectController extends AbstractController{

    //injection de dépendance pour le lier avec le repository
public function __construct(RoomRepository $repository, BathroomRepository $repo, 
ProductRepository $productsRepo)
{
    $this->repository = $repository;
    $this->repo = $repo;
    $this->productsRepo = $productsRepo;
}

/**
*
*@Route("/mesProjets", name="projects.index")
*@return Response
*/
public function index() : Response{
    $projectsRoom = $this->repository->findAllVisible();
    $projectsBathroom = $this->repo->findAllVisible();
    $products = $this->productsRepo->findAllVisible();

    return $this->render('projects/index.html.twig',[
        'current_menu' => 'projectsRoom',
        'projectsRoom' =>$projectsRoom,
        'projectsBathroom'=>$projectsBathroom,
        'products' => $products
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