<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private const CART_SESSION_KEY = 'cart';

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly ProductRepository $productRepository,
    ) {
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

    /**
     * Ajouter un produit au panier (ou incrémenter la quantité).
     */
    public function add(int $productId): void
    {
        $cart = $this->getSession()->get(self::CART_SESSION_KEY, []);

        $cart[$productId] = ($cart[$productId] ?? 0) + 1;

        $this->getSession()->set(self::CART_SESSION_KEY, $cart);
    }

    /**
     * Retirer un produit du panier.
     */
    public function remove(int $productId): void
    {
        $cart = $this->getSession()->get(self::CART_SESSION_KEY, []);

        unset($cart[$productId]);

        $this->getSession()->set(self::CART_SESSION_KEY, $cart);
    }

    /**
     * Décrémenter la quantité d'un produit.
     */
    public function decrement(int $productId): void
    {
        $cart = $this->getSession()->get(self::CART_SESSION_KEY, []);

        if (isset($cart[$productId])) {
            $cart[$productId]--;

            if ($cart[$productId] <= 0) {
                unset($cart[$productId]);
            }
        }

        $this->getSession()->set(self::CART_SESSION_KEY, $cart);
    }

    /**
     * Vider le panier.
     */
    public function clear(): void
    {
        $this->getSession()->remove(self::CART_SESSION_KEY);
    }

    /**
     * Obtenir le contenu détaillé du panier.
     *
     * @return array<array{product: Product, quantity: int}>
     */
    public function getCart(): array
    {
        $cart = $this->getSession()->get(self::CART_SESSION_KEY, []);
        $cartData = [];

        foreach ($cart as $productId => $quantity) {
            $product = $this->productRepository->find($productId);
            if ($product) {
                $cartData[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return $cartData;
    }

    /**
     * Calculer le total du panier.
     */
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getCart() as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }

    /**
     * Nombre total d'articles dans le panier.
     */
    public function getCount(): int
    {
        $cart = $this->getSession()->get(self::CART_SESSION_KEY, []);

        return array_sum($cart);
    }
}
