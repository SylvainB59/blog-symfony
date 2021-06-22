<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repoArticle;
    private $repoCategory;

    public function __construct(ArticleRepository $repoArticle, CategoryRepository $repoCategory) // INJECTION DE DEPENDANCE => (ArticleRepository $repoArticle)
    {
        $this->repoArticle = $repoArticle;
        $this->repoCategory = $repoCategory;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles= $this->repoArticle->findAll();
        $categories= $this->repoCategory->findAll();
        // dd($articles);
        return $this->render('home/index.html.twig',[
            "articles"=>$articles,
            "categories"=>$categories,
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id): Response
    {
        $article=$this->repoArticle->find($id);
        // dd($article);
        if(!$article){
            return $this->redirectToRoute('home');
        }

        return $this->render('home/show.html.twig',[
            "article"=>$article
        ]);
    }
}
