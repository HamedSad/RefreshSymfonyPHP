<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BathroomRepository;

class BathroomController extends AbstractController{

    public function __construct(BathroomRepository $repository){
        $this->repository = $repository;
    }

    /**
*@Route("/mesProjets/{slug}-{id}", name="project.show", requirements={"slug": "[a-z0-9\-]*"})
*@return Response
*/
public function show($slug, $id) : Response{

    $project =$this->repository->find($id);

    return $this->render('projects/showSDB.index.html.twig',[
        'project' => $project,
        'current_menu' => 'projects'
    ]);

}

}