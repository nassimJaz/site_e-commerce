<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, CartService $cartService): Response
    {
        $featuredProducts = $productRepository->findBy([], ['id' => 'ASC'], 4);

        return $this->render('home/index.html.twig', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
