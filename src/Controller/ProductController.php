<?php

namespace App\Controller;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
   #[Route('/nos-produits', name: 'app_products')]
    public function all(ProductRepository $repo): Response
    {
        $products = $repo->findAll();

        return $this->render('product/all.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/produit/{id}', name: 'app_product')]
    public function index(int $id, ProductRepository $repo): Response
    {
        $product = $repo->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvÃ©');
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }
}