<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Doctrine\Common\Persistence\ObjectManager;
class PromotionController extends AbstractController
{
    /**
     * @var PromotionRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PromotionRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;
    }

    /**
     * @Route("/admin/promotion/add",name="promotion-add")
    */

    public function add(Promotion $promotion=null,Request $request){
        if(!$promotion){
            $promotion= new Promotion();
        }
        $form= $this->createFormBuilder($promotion)
                     ->add('name')
                     ->add('pourcentage')
                     ->add('montant')
                     ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($promotion);
            $this->em->flush();
            
            return $this->redirectToRoute('promotion-list',['id'=>$promotion->getId()]);
        }
        return $this->render('admin/promotion/addPromotion.html.twig',[
            'formPromotion'=>$form->createView()
        ]);             
    }

    /**
     * @Route("admin/promotion/list",name="promotion-list")
     */
    public function list(){
        
        $promotion = $this->repository->findAll();
        return $this->render('admin/promotion/listPromotion.html.twig',[
            'promotion'=> $promotion 
        ]);
    }

}