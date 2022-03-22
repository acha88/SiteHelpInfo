<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    public function index(ObjectManager $manager): Response
    {
        for($i = 1; $i <= 10; $i++) {
            $article = new Article();
            $article->setTitleArticle("Titre de l'article n°$i")
                    ->setImage("https://via.placeholder.com/300x150")
                    ->setContenu("<p>Contenu de l'article n°$i</p>");

            $manager->persist($article);
        }
        $manager->flush();
    }
}