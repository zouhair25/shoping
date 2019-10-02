<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article;
use App\Entity\Menu;

use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;/**/
use App\Entity\Fabricant;
use App\Entity\Pointure;
use App\Entity\Taille;
use App\Entity\Couleur;
use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class AdminArticleController extends AbstractController
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
        $this->em = $em;
        $this->repository = $repository;

    }


     /**
     * @Route("/admin/article/add",name="article-add")
     * @Route("/admin/article/{id}/edit",name="article-edit")
     * @return Response
     */
    public function add(Article $article =null,Request $request)
    {
        
        if(!$article){
           // var_dump($article);die();
            $article = new Article();
        }
        $form =$this->createFormBuilder($article)
                 ->add("name")
                 ->add("menu",EntityType::class,[
                     'class' => Menu::class,
                     'choice_label' => 'name'
                 ])
                 ->add("fabricant",EntityType::class, [   
                      'class' => Fabricant::class,
                      'choice_label' => 'name'])
                 ->add('price')
                 ->add('color',EntityType::class,[
                     'class'=>Couleur::class,
                     'choice_label' =>'name',
                     'required' => false,
                 ])
                 ->add('categorie',EntityType::class,[
                    'class'=>Categorie::class,
                    'choice_label' =>'name'
                 ])
                 ->add("pointure",EntityType::class, [   
                    'class' => Pointure::class,
                    'choice_label' => 'size',
                    'required' => false])
                 ->add("taille",EntityType::class, [   
                        'class' => Taille::class,
                        'choice_label' => 'name'])
                 ->add("fabricant",EntityType::class, [   
                        'class' => Fabricant::class,
                        'choice_label' => 'name',
                        'required' => false])
                 ->add('description')
                 ->add('imageFile',FileType::class)

                 ->getForm();        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
        //$this->updatedAt = new \DateTime('now');

          $article ->setUpdatedAt(new \DateTime('now'));
           $this->em->persist($article);
           $this->em->flush();
        
           return $this->redirectToRoute('article-list',['id'=>$article->getId()]);
        }       
        return $this->render('admin/article/addArticle.html.twig',[
            'formArticle'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/list",name="article-list")
     * @return Response
     */
    public function list()
    {         
        $list = $this->repository->findAll();

        return $this->render('admin/article/listArticle.html.twig',[
            'article'=> $list 
        ]);
    }



}