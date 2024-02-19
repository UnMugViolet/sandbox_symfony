<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/produits', name: 'product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig');
    }

    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        // New product
        $product = new Product();
        // Create form
        $productForm = $this->createForm(ProductFormType::class, $product);

        // Handle form
        $productForm->handleRequest($request);

        // If form is submitted and valid
        if($productForm->isSubmitted() && $productForm->isValid()){
            // Set slug
            $slug = $slugger->slug($product->getName());
            $product->setSlug($slug);

            // Set date
            $product->setCreatedAt(new \DateTimeImmutable());

            // Set price in cents
            $price = $product->getPrice() * 100;
            $product->setPrice($price);

            // Save product
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Le produit a bien été ajouté');

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/add.html.twig',[
                'productForm' => $productForm->createView()
            ]);
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Product $product): Response
    {
        return $this->render('product/details.html.twig', compact('product'));
    }

}