<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\Product\ShowerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ShowerController extends AbstractController{

    public function __construct(ShowerRepository $repository){

        $this->repository = $repository;

    }

    /**
    *@Route("/ProductShower/{slug}-{id}", name="productShower.show", requirements={"slug": "[a-z0-9\-]*"})
    *@return Response
    */
    public function show($slug, $id): Response{

        $product = $this->repository->find($id);

        return $this->render('product/showShower.html.twig',[
            'product' => $product,
            'current_menu' => 'product'
        ]);

    }

}