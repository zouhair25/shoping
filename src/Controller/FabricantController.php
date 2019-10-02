<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Fabricant;
use App\Repository\FabricantRepository;
use Doctrine\Common\Persistence\ObjectManager;
class FabricantController extends AbstractController
{
    /**
     * @var FabricantRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(FabricantRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;
    }

    /**
     * @Route("/admin/fabricant/add",name="fabricant-add")
    */

    public function add(Fabricant $fabricant=null,Request $request){
        if(!$fabricant){
            $fabricant= new Fabricant();
        }
        $form= $this->createFormBuilder($fabricant)
                     ->add('name')
                     ->add('tel')
                     ->add('adress')
                     ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($fabricant);
            $this->em->flush();
            
            return $this->redirectToRoute('fabricant-list',['id'=>$fabricant->getId()]);
        }
        return $this->render('admin/fabricant/addFabricant.html.twig',[
            'formFabricant'=>$form->createView()
        ]);             
    }

    /**
     * @Route("admin/fabricant/list",name="fabricant-list")
     */
    public function list(){
        
        $fabricant = $this->repository->findAll();
        return $this->render('admin/fabricant/listFabricant.html.twig',[
            'fabricant'=> $fabricant 
        ]);
    }

}