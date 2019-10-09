<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Repository\TailleRepository;
use Doctrine\Common\Persistence\ObjectManager;
class SecurityController extends AbstractController
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
    * @Route("login",name="login")
    * @return Response
    */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {   $error =$authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            'lastUsername'=> $lastUsername ,
            'error'=> $error 
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