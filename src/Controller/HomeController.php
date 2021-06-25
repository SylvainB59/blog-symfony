<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repoArticle;
    private $repoCategory;
    private $repoUser;

    public function __construct(ArticleRepository $repoArticle, CategoryRepository $repoCategory, UserRepository $repoUser) // INJECTION DE DEPENDANCE => (ArticleRepository $repoArticle)
    {
        $this->repoArticle = $repoArticle;
        $this->repoCategory = $repoCategory;
        $this->repoUser = $repoUser;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles= $this->repoArticle->findAll();
        $categories= $this->repoCategory->findAll();
        $users= $this->repoUser->findAll();
        // dd($articles);
        return $this->render('home/index.html.twig',[
            "articles"=>$articles,
            "categories"=>$categories,
            "users"=>$users,
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(?Article $article): Response
    {
        if(!$article){
            return $this->redirectToRoute('home');
        }

        return $this->render('home/show.html.twig',[
            "article"=>$article
        ]);
    }

    /**
     * @Route("/showArticles/{id}", name="show_article")
     */
    public function showArticles(?Category $category): Response
    {
        if($category){
            $articles = $category->getArticles()->getValues();
        } else {
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig',[
            "articles"=>$articles,
            "categories"=>$this->repoCategory->findAll(),
            // "users"=>$this->repoUser->findAll(),
        ]);
    }

    /**
     * @Route("/showUserArticles/{id}", name="show_user_article")
     */
    public function showUserArticles(?User $user): Response{
        if($user){
            $articles = $user->getArticles()->getValues();
        } else {
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig',[
            "articles"=>$articles,
            "users"=>$this->repoUser->findAll(),
        ]);
    }
}
