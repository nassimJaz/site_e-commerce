# 👜 Boutique Symfony - Projet Test

Bienvenue dans ce projet de boutique en ligne développé avec **Symfony 8.0**. Ce projet sert de base pour démontrer les fonctionnalités essentielles d'un catalogue de produits avec gestion de panier et formulaire de contact.

## 🚀 Fonctionnalités

- **Catalogue de Produits** : Affichage d'une liste de sacs (maroquinerie) avec détails (titre, description, prix, stock).
- **Gestion du Panier** :
    - Ajouter des produits au panier depuis la boutique.
    - Modifier les quantités (incrémenter/décrémenter).
    - Supprimer un article ou vider complètement le panier.
    - Calcul automatique du total.
- **Formulaire de Contact** : Un formulaire complet pour contacter l'équipe, incluant la validation des données.
- **Page Lucky Number** : Une petite fonctionnalité bonus générant un nombre aléatoire.
- **Données de Test (Fixtures)** : Un jeu de données initial pour peupler la boutique dès l'installation.

## 🛠️ Stack Technique

- **Framework** : Symfony 8.0
- **Langage** : PHP 8.4+
- **Base de données** : SQLite (par défaut pour le test) ou MySQL via Doctrine ORM.
- **Frontend** : 
    - Twig pour le templating.
    - AssetMapper (importmap) pour la gestion du JavaScript sans Node.js.
    - Symfony UX Turbo & Stimulus pour une navigation fluide.
- **Tests** : PHPUnit.

## 📦 Installation

### 1. Cloner le projet
```bash
git clone <url-du-depot>
cd projet_test
```

### 2. Installer les dépendances
```bash
composer install
```

### 3. Configurer la base de données
Copiez le fichier `.env` en `.env.local` et adaptez la variable `DATABASE_URL`. Par défaut, SQLite est utilisé :
```bash
# .env.local
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

### 4. Créer la base de données et les tables
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction
```

### 5. Charger les données de test
```bash
php bin/console doctrine:fixtures:load --no-interaction
```

### 6. Lancer le serveur local
```bash
symfony serve
# ou
php -S localhost:8000 -t public
```

## 🧪 Tests

Pour lancer les tests unitaires et fonctionnels (ex: test du formulaire de contact) :
```bash
php bin/phpunit
```

## 📂 Structure du Projet

- `src/Controller/` : Logique de routage et de rendu (Boutique, Panier, Contact).
- `src/Entity/` : Modèles de données (Product).
- `src/Service/` : Logique métier réutilisable (CartService).
- `src/DataFixtures/` : Génération de données factices.
- `templates/` : Fichiers Twig pour l'affichage HTML.
- `public/images/products/` : Visuels des produits de la boutique.

