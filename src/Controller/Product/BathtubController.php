<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\Product\BathtubRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BathtubController extends AbstractController{

    public function __construct(BathtubRepository $repository){

        $this->repository = $repository;
    }

    /**
    *@Route("/ProductBathtub/{slug}-{id}", name="productBathtub.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id): Response{

        $product = $this->repository->find($id);

        return $this->render('product/showBathtub.html.twig',[
            'product' => $product,
            'current_menu' => 'product'
        ]);

    }

}