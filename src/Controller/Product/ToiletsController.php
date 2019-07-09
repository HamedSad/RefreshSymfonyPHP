<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\Product\ToiletsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ToiletsController extends AbstractController{

    public function __construct(ToiletsRepository $repository){

        $this->repository = $repository;

    }

    /**
    *@Route("/ProductToilets/{slug}-{id}", name="productToilets.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id): Response{

        $product = $this->repository->find($id);

        return $this->render('product/showToilets.html.twig',[
            'product' => $product,
            'current_menu' => 'product'
        ]);

    }

}