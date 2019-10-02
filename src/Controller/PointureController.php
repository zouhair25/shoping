<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Pointure;
use App\Repository\PointureRepository;
use Doctrine\Common\Persistence\ObjectManager;
class PointureController extends AbstractController
{
    /**
     * @var PointureRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PointureRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;
    }

    /**
     * @Route("/admin/pointure/add",name="pointure-add")
    */

    public function add(Pointure $pointure=null,Request $request){
        if(!$pointure){
            $pointure= new Pointure();
        }
        $form= $this->createFormBuilder($pointure)
                     ->add('size')
                     
                     ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($pointure);
            $this->em->flush();
            
            return $this->redirectToRoute('pointure-list',['id'=>$pointure->getId()]);
        }
        return $this->render('admin/pointure/addPointure.html.twig',[
            'formPointure'=>$form->createView()
        ]);             
    }

    /**
     * @Route("admin/pointure/list",name="pointure-list")
     */
    public function list(){
        
        $pointure = $this->repository->findAll();
        return $this->render('admin/pointure/listPointure.html.twig',[
            'pointure'=> $pointure 
        ]);
    }

}