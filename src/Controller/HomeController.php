<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


use App\Entity\Categorie;
use App\Entity\Article;

use App\Repository\ArticleRepository;
use App\Repository\TailleRepository;
use App\Repository\MenuRepository;
use App\Repository\CategorieRepository;
use App\Repository\CouleurRepository;


use Doctrine\Common\Persistence\ObjectManager;
class HomeController extends AbstractController
{

    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(ArticleRepository $repository,ObjectManager $em){
        $this->em=$em;
        $this->repository=$repository;

    }
   
/**
 * @Route("/add",name="property.index")
 * @return Response
 */
   
    public function add(): Response
    {

        $property = new Property();
        $property->setTitle("Mon premier article")
                 ->setDescription("Mon premier article description")
                 ->setSurface(400)
                 ->setRooms(4)
                 ->setBedrooms(3)
                 ->setPrice(300000)
                 ->setHeat(1)
                 ->setCity("Rabat")
                 ->setAdress("Hay anakhil")
                 ->setPostalCode("20010")
                 ->setSold("20010")
                 ;
        $manager =$this->getDoctrine()->getManager();
        $manager->persist($property);
        $manager->flush();
        return $this->render('property/index.html.twig');
    }

    /**
     * @Route("/",name="home")
     * @return Response
     */
    
    public function index(ArticleRepository $repository,MenuRepository $item): Response
    {

        $item = $item->findAll(); 
        //dump($item);die();
        $article = $repository->findAll(); 


        return $this->render('home/index.html.twig',['article'=>$article,'item'=>$item]);
    }

    /**
     * @Route("/detail/{item}/{id}",name="detail-article")
     * 
     */
    
    public function detail(ArticleRepository $repository,$id)
    {
      $article = $repository->find($id);
      //var_dump($article);die();
        return $this->render('home/detail.html.twig',['article'=>$article]);
    }
    

     /**
     * @Route("/categorie/list",name="categorie-list")
     * @return Response
     */
    public function categorieList(CategorieRepository $repository): Response
    {     
        $categorie = $repository->findAll(); 
        return $this->render('includeModule/categorie.html.twig',['categorie'=>$categorie]);
    }

     /**
     * @Route("/couleur/list",name="couleur-list")
     * @return Response
     */
    public function couleurList(CouleurRepository $repository): Response
    {     
        $couleur = $repository->findAll(); 
        return $this->render('includeModule/couleur.html.twig',['couleur'=>$couleur]);
    }

     /**
     * @Route("/taille/list",name="taille-list-front")
     * @return Response
     */
    public function tailleList(TailleRepository $repository): Response
    {     
        $taille = $repository->findAll(); 
        return $this->render('includeModule/taille.html.twig',['taille'=>$taille]);
    }
    
    /**
     * @Route("/article/{name}/{item}",name="article-item")
     * @return Response
     */
    public function articleItem(ArticleRepository $repository,$item): Response
    {     
        $article = $repository->findByItem($item); 
        return $this->render('home/listArticleByItem.html.twig',['article'=>$article]);
    }

}