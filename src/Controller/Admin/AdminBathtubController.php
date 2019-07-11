<?php

namespace App\Controller\Admin;

use App\Repository\Product\BathtubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product\Bathtub;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class AdminBathtubController extends AbstractController{

    /**
    *@var BathtubRepository
    */
    private $repository;

    public function __construct(BathtubRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    // /**
    // *@Route("/admin", name="admin.bathtub.index")
    // *@return Response
    // */
    // public function index() : Response{
    //     $productBathtub = $this->repository->findAll();
    // //Je génère ma vu via un return, que l'on va mettre ds un dossier admin et on lui envoie un tableau comportant projects
    //     return $this->render('admin/index.html.twig', [
    //     'productBathtub'=>$productBathtub
    //     ]);
    // }

    // /**
    // *@Route("/admin/bathtub/{id}", name="admin.bathtub.delete", methods="DELETE")
    // *@param Bathtub $bathtub
    // *@return Response
    // */
    // public function delete(Bathtub $bathtub, Request $request){
    //     $submittedToken = $request->request->get('_token');
    //     //vérification de la valeur du token csrf pour le form suppression soit bien valide
    //     if ($this->isCsrfTokenValid('delete', $submittedToken)) {
    //         $this->em->remove($bathtub);
    //         $this->em->flush();
    //         //message de confirmation de création de projet 
    //         $this->addFlash('success', 'Le produit baingoire a bien été supprimé');
    //         //return new Response('Suppression');
    //         }
            
    //         return $this->redirectToRoute('admin.bathtub.index');
    //     }
}