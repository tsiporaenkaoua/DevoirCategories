<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories=$categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
           'liste_categories'=>$categories
        ]);
    }

    #[Route('/{id}', name: 'app_category_articles')]
    public function detail(ArticleRepository $articleRepository, Category $category): Response
    {
       $articles = $articleRepository->findBy(
            [
                'category' => $category->getId()
            ]
            );
            
        return $this->render('category/detail.html.twig', [
           'articles'=>$articles
        ]);
    }
}
