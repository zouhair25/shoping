<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Couleur;
use App\Repository\CouleurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
class CouleurController extends AbstractController
{

    /**
     * @var CouleurRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(CouleurRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;

    }

    
   /**
    * @Route("admin/couleur/add",name="couleur-add")
    * @return Response
    */
    public function add(Couleur $couleur =null,Request $request)
    {
      if(!$couleur){
        $couleur = new Couleur();
      }
      $form= $this->createFormBuilder($couleur)
                  ->add('name',ColorType::class)
                  ->getForm();
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           //var_dump($taille);die();
           $this->em->persist($couleur);
           $this->em->flush();

           return $this->redirectToRoute('couleur-list',['id'=>$couleur->getId()]);
       }
       return $this->render('admin/couleur/addCouleur.html.twig',[
        'formCouleur'=> $form->createView()
    ]);
    }



    /**
     * @Route("/admin/couleur/list",name="couleur-list")
     * @return Response
     */
    public function list()
    {         
        $list = $this->repository->findAll();

        return $this->render('admin/couleur/listCouleur.html.twig',[
            'couleur'=> $list 
        ]);
    }




}