<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BathroomRepository;
use App\Repository\Product\PaintRepository;
use App\Repository\Product\BathtubRepository;
use App\Repository\Product\ShowerRepository;
use App\Repository\Product\SinkRepository;
use App\Repository\Product\ToiletsRepository;

class BathroomController extends AbstractController{

    public function __construct(BathroomRepository $repository, PaintRepository $paintRepo, 
    BathtubRepository $bathtubRepo, ShowerRepository $showerRepo, SinkRepository $sinkRepo, ToiletsRepository $toiletsRepo){
        $this->repository = $repository;
        $this->paintRepo = $paintRepo;
        $this->bathtubRepo = $bathtubRepo;
        $this->showerRepo = $showerRepo;
        $this->sinkRepo = $sinkRepo;
        $this->toiletsRepo = $toiletsRepo;
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

}