<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Taille;
use App\Repository\TailleRepository;
use Doctrine\Common\Persistence\ObjectManager;
class TailleController extends AbstractController
{

    /**
     * @var TailleRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(TailleRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;

    }

    
   /**
    * @Route("admin/taille/add",name="taille-add")
    * @return Response
    */
    public function add(Taille $taille =null,Request $request)
    {
      if(!$taille){
        $taille  = new Taille();
      }
      $form= $this->createFormBuilder($taille)
                  ->add('name')
                  ->getForm();
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           //var_dump($taille);die();
           $this->em->persist($taille);
           $this->em->flush();

           return $this->redirectToRoute('taille-list',['id'=>$taille->getId()]);
       }
       return $this->render('admin/taille/addTaille.html.twig',[
        'formTaille'=> $form->createView()
    ]);
    }



    /**
     * @Route("/admin/taille/list",name="taille-list")
     * @return Response
     */
    public function list()
    {         
        $list = $this->repository->findAll();

        return $this->render('admin/taille/listTaille.html.twig',[
            'taille'=> $list 
        ]);
    }




}