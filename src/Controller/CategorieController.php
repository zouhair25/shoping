<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Common\Persistence\ObjectManager;
class CategorieController extends AbstractController
{

    /**
     * @var CategorieRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(CategorieRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;

    }

    
   /**
    * @Route("admin/categorie/add",name="categorie-add")
    * @return Response
    */
    public function add(Categorie $categorie =null,Request $request)
    {
      if(!$categorie){
        $categorie = new Categorie();
      }
      $form= $this->createFormBuilder($categorie)
                  ->add('name')
                  ->getForm();
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           //var_dump($taille);die();
           $this->em->persist($categorie);
           $this->em->flush();

           return $this->redirectToRoute('categorie-list',['id'=>$categorie->getId()]);
       }
       return $this->render('admin/categorie/addCategorie.html.twig',[
        'formCategorie'=> $form->createView()
    ]);
    }



    /**
     * @Route("/admin/categorie/list",name="categorie-list")
     * @return Response
     */
    public function list()
    {         
        $list = $this->repository->findAll();

        return $this->render('admin/categorie/listCategorie.html.twig',[
            'categorie'=> $list 
        ]);
    }




}