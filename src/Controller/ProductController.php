<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;

class ProductController extends AbstractController{

    //injection de dépendance pour le lier avec le repository
public function __construct(ProductRepository $repository, ObjectManager $em){
    $this->repository = $repository;
    $this->em = $em;
}

/**
     *@Route("/Product/{slug}-{id}", name="product.show", requirements={"slug": "[a-z0-9\-]*"})
     *@return Response
     */
    public function show($slug, $id): Response
    {

        $product = $this->repository->find($id);

        return $this->render('product/product.show.html.twig', [
            'product' => $product,
            'current_menu' => 'product'
        ]);
    }

}