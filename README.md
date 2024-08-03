# Projet de Gestion de Caisse

## Description

Ce projet est une application de gestion de caisse destinée à un restaurant. Elle permet de gérer les produits, suivre les ventes, et imprimer les reçus. L'application est développée en PHP et JavaScript (AJAX), avec une base de données SQLite pour stocker les informations.

### Fonctionnalités

- **Gestion des produits** : Ajout, modification, suppression, et consultation des produits.
- **Gestion des catégories** : Organisation des produits en différentes catégories.
- **Suivi des ventes** : Affichage des ventes totales journalières, hebdomadaires, mensuelles, et annuelles.
- **Génération de reçus** : Création et impression de reçus pour chaque transaction.
- **Rapports de vente** : Visualisation des données de vente avec des graphiques.

## Installation

### Prérequis

- Serveur web compatible avec PHP (ex. : XAMPP, WAMP).
- SQLite installé.
- Navigateur web moderne (Chrome, Firefox, etc.).

### Étapes d'installation

1. **Clonez le dépôt**

2. **Accédez au répertoire du projet**

    ```bash
    cd Gestion_Caisse
    ```

3. **Configurez la base de données**

    Assurez-vous que le fichier de base de données SQLite (`caisse.db`) est présent dans le répertoire `BDD/`. Si ce n'est pas le cas, importez le fichier de base de données fourni ou créez-le selon le schéma de base de données fourni ci-dessous.

4. **Configurer le serveur web**

    Placez le projet dans le répertoire racine de votre serveur web (ex. : `htdocs` pour XAMPP).

5. **Accédez à l'application**

    Ouvrez votre navigateur et accédez à `http://localhost/gestion_Caisse/index.php`.

## Schéma de Base de Données

Les tables de la base de données sont les suivantes :

- `produits(id, nom, prix, img, categorie_id)`
- `categorie(id, nom)`
- `transactions(id, total, date)`
- `transaction_details(id, transaction_id, produit_id, quantite)`

## Utilisation

1. **Gestion des produits**

   Accédez à la section dédiée pour ajouter, modifier ou supprimer des produits.

2. **Suivi des ventes**

   Consultez les rapports de ventes en accédant aux différentes options de période (journalière, hebdomadaire, mensuelle, annuelle).

3. **Impression des reçus**

   Après chaque transaction, utilisez l'option pour imprimer un reçu.

4. **Visualisation des données**

   Les graphiques affichent les ventes totales par période sélectionnée.