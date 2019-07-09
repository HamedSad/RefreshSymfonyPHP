<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\Product\SinkRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SinkController extends AbstractController{

    public function __construct(SinkRepository $repository){

        $this->repository = $repository;

    }

    /**
    *@Route("/ProductSink/{slug}-{id}", name="productSink.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id): Response{

        $product = $this->repository->find($id);

        return $this->render('product/showSink.html.twig',[
            'product' => $product,
            'current_menu' => 'product'
        ]);

    }

}