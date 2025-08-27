# Symfony Testing Project

## 📋 Description

Ce projet est un environnement d'apprentissage pour les tests unitaires et fonctionnels avec Symfony. Il utilise Docker pour garantir un environnement de développement cohérent et reproductible.

## 🎯 Objectifs du projet

L'objectif de ce projet est de maîtriser les différents types de tests dans l'écosystème Symfony :

- **Tests avec base de données** - Gérer les données de test 
- **Tests d'entités** - Valider la logique métier des modèles
- **Tests de validateurs** - Vérifier les contraintes de validation personnalisées
- **Tests d'EventSubscriber** - Tester les événements et leurs écouteurs
- **Tests de contrôleurs** - Tests fonctionnels des endpoints API/Web

## 📚 Formation suivie

Ce projet s'appuie sur la formation [Symfony Tests](https://grafikart.fr/formations/symfony-tests) de Grafikart, qui couvre les bonnes pratiques de test avec Symfony.

## 🏗️ Stack technique

- **Framework** : Symfony 7.x
- **Serveur Web** : FrankenPHP avec Caddy
- **Base de données** : PostgreSQL
- **Tests** : PHPUnit
- **Docker** : Template [symfony-docker](https://github.com/dunglas/symfony-docker) par Kévin Dunglas

## 🚀 Guide de Démarrage

Suivez ces étapes dans l'ordre pour une installation complète.

### 1. Installation

```bash
# Clonez le projet
git clone https://github.com/younes-bkb/TestLab.git symfony-tests
cd symfony-tests

# Construisez et lancez les conteneurs Docker
docker compose up --build -d

# Installez les dépendances PHP avec Composer (via Docker)
docker compose exec php composer install
```

### 2. Configuration de la base de données de DÉVELOPPEMENT

Ces commandes préparent la base de données que vous utilisez en local pour développer et tester dans votre navigateur.

```bash
# Crée la base de données "app" dans le conteneur PostgreSQL
docker compose exec php bin/console doctrine:database:create

# Applique les migrations pour créer le schéma (les tables, colonnes, etc.)
docker compose exec php bin/console doctrine:migrations:migrate

# Charge les données de test (fixtures) dans la base de développement
docker compose exec php bin/console doctrine:fixtures:load
```
Votre environnement de développement est maintenant prêt ! Vous pouvez y accéder via **https://localhost**.

### 3. Configuration de la base de données de TEST

Les tests automatisés ont besoin de leur propre base de données isolée pour garantir des résultats fiables et ne pas impacter vos données de développement. Par convention, Symfony ajoute le suffixe `_test` au nom de la base.

```bash
# 1. Crée la base de données de test "app_test"
docker compose exec php bin/console doctrine:database:create --env=test

# 2. Crée le schéma de la base de test à partir de vos entités
docker compose exec php bin/console doctrine:schema:update --force --env=test

# 3. Charge les fixtures dans la base de test pour que vos tests aient des données sur lesquelles travailler
docker compose exec php bin/console doctrine:fixtures:load --env=test
```
L'environnement de test est maintenant configuré. Vous ne devez faire ces étapes qu'une seule fois.

## ✅ Lancer les tests

Une fois la configuration terminée, vous pouvez lancer votre suite de tests avec une seule commande.

```bash
# Lancer tous les tests avec PHPUnit
docker compose exec php bin/phpunit
```

## 🛠️ Commandes utiles au quotidien

```bash
# Accéder à la console Symfony
docker compose exec php bin/console

# Accéder au shell du conteneur PHP
docker compose exec php sh

# Installer un nouveau paquet avec Composer
docker compose exec php composer require nom-du-paquet

# Arrêter les conteneurs
docker compose down
```

## 🔗 Ressources

- [Formation Symfony Tests - Grafikart](https://grafikart.fr/formations/symfony-tests)
- [Symfony Docker - Kévin Dunglas](https://github.com/dunglas/symfony-docker)