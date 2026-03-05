<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/boutique', name: 'app_boutique')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $category = $request->query->get('category');

        if ($category) {
            $products = $productRepository->findBy(['category' => $category]);
        } else {
            $products = $productRepository->findAll();
        }

        // Récupérer les catégories uniques pour le filtre
        $allProducts = $productRepository->findAll();
        $categories = array_unique(array_map(
            fn($p) => $p->getCategory(),
            $allProducts,
        ));

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
        ]);
    }

    #[Route('/produit/{id}', name: 'app_product_show')]
    public function show(int $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
