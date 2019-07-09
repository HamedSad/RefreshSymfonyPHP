<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Product\PaintRepository;

class PaintController extends AbstractController{

    public function __construct(PaintRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
    *@Route("/ProductPaint/{slug}-{id}", name="productPaint.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id) : Response{

        $product =$this->repository->find($id);
    
        return $this->render('product/showPaint.html.twig',[
            'product' => $product,
            'current_menu' => 'product'
        ]);
    
    }

}