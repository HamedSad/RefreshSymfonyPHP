<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Form\ProductType;

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
    *@Route("/nouveauProduit", name="admin.product.new", methods="GET|POST")
    */
    public function new(Request $request){
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if($form->isSubmitted()  && $form->isValid()){
            $this->em->persist($product);   
            $this->em->flush();
            $this->addFlash('success', 'Votre produit a bien été créé');
            return $this->redirectToRoute('admin.index');
        }
        return $this->render('admin/newProduct.html.twig', [
            //On envoie le tout à la vue
            'product'=> $product,
            'form'=>$form->createView()
            ]); 
    }

        /**
    *@Route("/editerProduit/{id}", name="admin.product.edit")
    *@param Product $product
    *@param Request $request
    *@return Response
    */
    public function edit(Product $product, Request $request){
        //methode create form pour utiliser le formulaire avec le nom du formulaire et la mon entité qui comprendra toutes mes variables
        $form = $this->createForm(ProductType::class, $product);

        //utilisation de la methode handleRequest issue de la class Request
        $form->handleRequest($request);

        //le formulaire a t il été envoyé et est-il valide?
        if($form->isSubmitted()  && $form->isValid()){
            //Si les données sont valides il va mettre à jour la BDD
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Votre produit a bien été modifié');
            //redirection de l'user vers admine.project.index
            return $this->redirectToRoute('admin.index');
        }
        //puis je lui dis de se rendre sur la page admin/project/edit.html
        return $this->render('admin/editProduct.html.twig', [
            //On envoie le tout à la vue
            'product'=> $product,
            'form'=>$form->createView()
            ]);     
    }

    /**
    *@Route("/admin/{id}", name="admin.delete", methods="DELETE")
    *@param Product $product
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