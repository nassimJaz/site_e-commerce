<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'title' => 'Sac Élégance Noir',
                'description' => 'Un sac cabas intemporel en cuir grainé noir, orné de finitions dorées. Sa silhouette structurée et ses doubles anses offrent un style raffiné pour toutes les occasions. Compartiment principal spacieux avec poche intérieure zippée.',
                'price' => 189.00,
                'image' => 'sac-elegance-noir.jpg',
                'category' => 'Cabas',
                'stock' => 12,
            ],
            [
                'title' => 'Le Pliage Rosé',
                'description' => 'Tote bag léger et pratique, inspiré des grands classiques parisiens. Toile résistante couleur rosé poudré avec rabat et anses en cuir marron. Parfait pour le quotidien comme pour les escapades du week-end.',
                'price' => 145.00,
                'image' => 'le-pliage-rose.jpg',
                'category' => 'Tote',
                'stock' => 18,
            ],
            [
                'title' => 'Sac Anneau Ivoire',
                'description' => 'Petit sac à main compact en cuir lisse ivoire, sublimé par un anneau doré signature. Son format crossbody permet un port bandoulière élégant. Idéal pour un look chic et minimaliste.',
                'price' => 165.00,
                'image' => 'sac-anneau-ivoire.jpg',
                'category' => 'Bandoulière',
                'stock' => 8,
            ],
            [
                'title' => 'Sac Messenger Noir',
                'description' => 'Sac bandoulière en cuir noir avec fermoir tournant doré et bandoulière ajustable à œillets. Design épuré et contemporain, parfait pour un style urbain sophistiqué. Doublure intérieure en coton.',
                'price' => 210.00,
                'image' => 'sac-messenger-noir.jpg',
                'category' => 'Bandoulière',
                'stock' => 6,
            ],
        ];

        foreach ($products as $data) {
            $product = new Product();
            $product->setTitle($data['title']);
            $product->setDescription($data['description']);
            $product->setPrice($data['price']);
            $product->setImage($data['image']);
            $product->setCategory($data['category']);
            $product->setStock($data['stock']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
