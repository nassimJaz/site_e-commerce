<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/panier', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getCart(),
            'total' => $cartService->getTotal(),
        ]);
    }

    #[Route('/panier/ajouter/{id}', name: 'app_cart_add', methods: ['POST'])]
    public function add(int $id, CartService $cartService): Response
    {
        $cartService->add($id);

        $this->addFlash('success', 'Produit ajouté au panier !');

        return $this->redirectToRoute('app_boutique');
    }

    #[Route('/panier/supprimer/{id}', name: 'app_cart_remove', methods: ['POST'])]
    public function remove(int $id, CartService $cartService): Response
    {
        $cartService->remove($id);

        $this->addFlash('info', 'Produit retiré du panier.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/panier/decrement/{id}', name: 'app_cart_decrement', methods: ['POST'])]
    public function decrement(int $id, CartService $cartService): Response
    {
        $cartService->decrement($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/panier/increment/{id}', name: 'app_cart_increment', methods: ['POST'])]
    public function increment(int $id, CartService $cartService): Response
    {
        $cartService->add($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/panier/vider', name: 'app_cart_clear', methods: ['POST'])]
    public function clear(CartService $cartService): Response
    {
        $cartService->clear();

        $this->addFlash('info', 'Panier vidé.');

        return $this->redirectToRoute('app_cart');
    }
}
