<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index(): Response {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('site/home.html.twig', [
            'title' => "Help Info",
        ]);
    }

    /**
     * @Route("/site/appli", name="appli")
     */
    public function appli(ArticleRepository $repo) {
        $article = $repo->findAll();
        return $this->render('site/appli.html.twig', [
            'title' => "Help Info",
            'article' => $article
        ]);
    }  

    /**
    * @Route("/site/mooc", name="mooc")
    */
    public function mooc() {
        return $this->render('site/mooc.html.twig');
    }
    /**
    * @Route("/site/demo", name="demo") 
    */
    public function demo() {
        return $this->render('site/demo.html.twig');
    }
}
