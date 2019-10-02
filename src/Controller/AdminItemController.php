<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\Common\Persistence\ObjectManager;
class AdminItemController extends AbstractController
{

    /**
     * @var MenuRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(MenuRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;

    }
   
    /**
     * @Route("/admin/item/add",name="item-add")
     * @return Response
     */
   
    public function add(Menu $menu =null,Request $request)
    {
        if(!$menu){
            $menu = new Menu();
        }
        $form =$this->createFormBuilder($menu)
                 ->add("name")
                 ->add("position")
                 ->add("path")
                 ->add('active')
                 ->getForm();        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $this->em->persist($menu);
           $this->em->flush();
        }
        return $this->render('admin/item/addItem.html.twig',[
            'formMenu'=> $form->createView()
        ]);
    }



     /**
     * @Route("/admin/item/list",name="item-list")
     * @return Response
     */
   
    public function index(): Response
    {     
        $items = $this->repository->findAllVisible();
        //dump($menu);

        //$manager->persist($property);
        //$manager->flush();
        return $this->render('admin/item/listItem.html.twig',[
            'items'=>$items]);
    }



     /**
     * @Route("/menu/hedearFront",name="menu.list")
     * @return Response
     */
   
    public function hedearFront()
    {

        //$this->repository->findAll();
        $list = $this->repository->findAll();
        //var_dump($list);die();

        return $this->render('includeModule/item.html.twig',[
            'list'=>$list
        ]);
    }


}