# Symfony Testing Project

## 📋 Description

Ce projet est un environnement d'apprentissage pour les tests unitaires et fonctionnels avec Symfony. Il utilise Docker pour garantir un environnement de développement cohérent et reproductible.

## 🎯 Objectifs du projet

L'objectif de ce projet est de maîtriser les différents types de tests dans l'écosystème Symfony :

- **Tests avec base de données** - Gérer les données de test et les transactions
- **Tests d'entités** - Valider la logique métier des modèles
- **Tests de validateurs** - Vérifier les contraintes de validation personnalisées
- **Tests d'EventSubscriber** - Tester les événements et leurs écouteurs
- **Tests de contrôleurs** - Tests fonctionnels des endpoints API/Web

## 📚 Formation suivie

Ce projet s'appuie sur la formation [Symfony Tests](https://grafikart.fr/formations/symfony-tests) de Grafikart, qui couvre en profondeur les bonnes pratiques de test avec Symfony.

## 🏗️ Stack technique

- **Framework** : Symfony 7.x
- **Serveur Web** : FrankenPHP avec Caddy
- **Base de données** : PostgreSQL
- **Tests** : PHPUnit
- **Docker** : Template [symfony-docker](https://github.com/dunglas/symfony-docker) par Kévin Dunglas

## 🚀 Installation

```bash
git clone https://github.com/younes-bkb/TestLab.git symfony-tests
cd symfony-tests
docker compose up -d
```

Accès : https://localhost

## Commandes

```bash
# Lancer tous les tests
docker compose exec php bin/phpunit

# Console Symfony
docker compose exec php bin/console

# Créer la base de données
docker compose exec php bin/console doctrine:database:create
```

## 🔗 Ressources

- [Formation Symfony Tests - Grafikart](https://grafikart.fr/formations/symfony-tests)
- [Symfony Docker - Kévin Dunglas](https://github.com/dunglas/symfony-docker)