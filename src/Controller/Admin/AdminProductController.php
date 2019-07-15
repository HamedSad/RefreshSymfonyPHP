<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ProductRepository;
use App\Entity\Product;

class AdminProductController extends AbstractController{

    /**
    *@var PaintRepository
    */
    private $repository;

    public function __construct(ProductRepository $productRepository,
    ObjectManager $em)
    {
        //$this->repository = $repository;
        $this->productRepository = $productRepository;
        $this->em = $em;
    }

    /**
    *@Route("/admin", name="admin.index")
    *@return Response
    */
    public function index() : Response{
        $productRepository = $this->productRepository->findAll();
    //Je génère ma vu via un return, que l'on va mettre ds un dossier admin et on lui envoie un tableau comportant projects
        return $this->render('admin/index.html.twig', [
        'products' => $productRepository
        ]);
    }

    /**
    *@Route("/admin/{id}", name="admin.delete", methods="DELETE")
    *@param Bathtub $bathtub
    *@return Response
    */
    public function delete(Product $product, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            
            $this->em->remove($product);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Le produit a bien été supprimé');
            //return new Response('Suppression');
            }          
            return $this->redirectToRoute('admin.index');
        }
}