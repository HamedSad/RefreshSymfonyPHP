<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product\Paint;
use App\Entity\Product\Bathtub;
use App\Entity\Product\Shower;
use App\Entity\Product\Sink;
use App\Entity\Product\Toilets;
use App\Repository\Product\BathtubRepository;
use App\Repository\Product\PaintRepository;
use App\Repository\Product\ShowerRepository;
use App\Repository\Product\SinkRepository;
use App\Repository\Product\ToiletsRepository;
use Doctrine\Common\Persistence\ObjectManager;

class AdminProductController extends AbstractController{

    /**
    *@var PaintRepository
    */
    private $repository;

    public function __construct(PaintRepository $repository, BathtubRepository $bathtubRepo, ShowerRepository $showerRepo,
    SinkRepository $sinkRepo, ToiletsRepository $toiletsRepo, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->bathtubRepo = $bathtubRepo;
        $this->showerRepo = $showerRepo;
        $this->sinkRepo = $sinkRepo;
        $this->toiletsRepo = $toiletsRepo;
        $this->em = $em;
    }

    /**
    *@Route("/admin", name="admin.index")
    *@return Response
    */
    public function index() : Response{
        $productPaint = $this->repository->findAll();
        $productBathtub = $this->bathtubRepo->findAll();
        $productShower = $this->showerRepo->findAll();
        $productSink = $this->sinkRepo->findAll();
        $productToilets = $this->toiletsRepo->findAll();
    //Je génère ma vu via un return, que l'on va mettre ds un dossier admin et on lui envoie un tableau comportant projects
        return $this->render('admin/index.html.twig', [
        'productPaint'=>$productPaint,
        'productBathtub' => $productBathtub,
        'productShower' => $productShower,
        'productSink' => $productSink,
        'productToilets' =>$productToilets
        ]);
    }

    /**
    *@Route("/admin/Paint/{id}", name="admin.delete.paint", methods="DELETE")
    *@param Paint $paint
    *@return Response
    */
    public function deletePaint( Paint $paint, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            
            $this->em->remove($paint);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Le produit peinture a bien été supprimé');
            //return new Response('Suppression');
            }
            
            return $this->redirectToRoute('admin.index');
        }


    /**
    *@Route("/admin/Bathrub/{id}", name="admin.delete.bathtub", methods="DELETE")
    *@param Bathtub $bathtub
    *@return Response
    */
    public function deleteBathtub(Bathtub $bathtub, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            
            $this->em->remove($bathtub);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Le produit baignoire a bien été supprimé');
            //return new Response('Suppression');
            }
            
            return $this->redirectToRoute('admin.index');
        }


    /**
    *@Route("/admin/Shower/{id}", name="admin.delete.shower", methods="DELETE")
    *@param Shower $shower
    *@return Response
    */
    public function deleteShower(Shower $shower, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            
            $this->em->remove($shower);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Le produit douche a bien été supprimé');
            //return new Response('Suppression');
            }
            
            return $this->redirectToRoute('admin.index');
        }

    /**
    *@Route("/admin/Sink/{id}", name="admin.delete.sink", methods="DELETE")
    *@param Sink $sink
    *@return Response
    */
    public function deleteSink(Sink $sink, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            
            $this->em->remove($sink);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Le produit évier a bien été supprimé');
            //return new Response('Suppression');
            }
            
            return $this->redirectToRoute('admin.index');
        }

    /**
    *@Route("/admin/Toilets/{id}", name="admin.delete.toilets", methods="DELETE")
    *@param Toilets $toilets
    *@return Response
    */
    public function deleteToilets(Toilets $toilets, Request $request){
        $submittedToken = $request->request->get('_token');
        //vérification de la valeur du token csrf pour le form suppression soit bien valide
        if ($this->isCsrfTokenValid('delete', $submittedToken)) {
            
            $this->em->remove($toilets);
            $this->em->flush();
            //message de confirmation de création de projet 
            $this->addFlash('success', 'Le produit évier a bien été supprimé');
            //return new Response('Suppression');
            }
            
            return $this->redirectToRoute('admin.index');
        }

}