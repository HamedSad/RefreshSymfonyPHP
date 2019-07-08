<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BathroomRepository;

//Création de ma classe RoomController
class RoomController extends AbstractController{

//injection de dépendance pour le lier avec le repository
public function __construct(RoomRepository $repository)
{
    $this->repository = $repository;
}

//mise en place de la route et de son nom
/**
*@Route("/mesProjets/{slug}-{id}", name="project.show", requirements={"slug": "[a-z0-9\-]*"})
*@return Response
*/
public function show($slug, $id) : Response{

    $project =$this->repository->find($id);

    return $this->render('projects/showRoom.index.html.twig',[
        'project' => $project,
        'current_menu' => 'projects'
    ]);

}

}