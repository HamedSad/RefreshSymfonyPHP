<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoomRepository;
use App\Repository\Product\PaintRepository;
use App\Repository\Product\BathtubRepository;
use App\Repository\Product\ShowerRepository;
use App\Repository\Product\SinkRepository;
use App\Repository\Product\ToiletsRepository;
use Symfony\Component\HttpFoundation\Request;

//Création de ma classe RoomController
class RoomController extends AbstractController{

//injection de dépendance pour le lier avec le repository
public function __construct(RoomRepository $repository, PaintRepository $paintRepo, 
BathtubRepository $bathtubRepo, ShowerRepository $showerRepo, SinkRepository $sinkRepo, ToiletsRepository $toiletsRepo)
{
    $this->repository = $repository;
    $this->paintRepo = $paintRepo;
    $this->bathtubRepo = $bathtubRepo;
    $this->showerRepo = $showerRepo;
    $this->sinkRepo = $sinkRepo;
    $this->toiletsRepo = $toiletsRepo;
}

//mise en place de la route et de son nom
/**
*@Route("/mesProjetsRoom/{slug}-{id}", name="projectRoom.show", requirements={"slug": "[a-z0-9\-]*"})
*@return Response
*/
public function show($slug, $id) : Response{

    $project =$this->repository->find($id);
    $productPaint = $this->paintRepo->findAllVisiblePaint();
    $productBathtub = $this->bathtubRepo->findAllVisibleBathtub();
    $productShower = $this->showerRepo->findAllVisibleShower();
    $productSink = $this->sinkRepo->findAllVisibleSink();
    $productToilets = $this->toiletsRepo->findAllVisibleToilets();

    return $this->render('projects/showRoom.index.html.twig',[
        'project' => $project,
        'current_menu' => 'projects',
        'productPaint'=>$productPaint,
        'productBathtub'=>$productBathtub,
        'productShower'=>$productShower,
        'productSink'=>$productSink,
        'productToilets'=>$productToilets
    ]);

    }

}