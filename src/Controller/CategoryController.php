<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories', name: 'category_')]
class CategoryController extends AbstractController
{
    
    #[Route('/{slug}', name: 'list')]
    public function list(Category $category): Response
    {
        $product = $category->getProducts();

        return $this->render('category/list.html.twig', [
            'category' => $category,
            'products' => $product
        ]);
    }
}
