<?php
    function dbConnect() {
        try {
            // Connexion à la base de données SQLite
            $database = new PDO('sqlite:../BDD/caisse.db');
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $database;
        } catch (PDOException $e) {
            handleDatabaseError($e->getMessage());
        }
    }

    function handleDatabaseError($errorMessage) { // Gestion des erreurs de base de données
        exit("Erreur de base de données : " . $errorMessage);
    }

    function getAllProd(){
        $database = dbConnect();
        $query = $database->prepare('SELECT * FROM produits');
        $query->execute(); return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProdByCatId(){
        $database = dbConnect();
        $query = $database->prepare('SELECT * FROM produits WHERE categorie_id = :category_id');
        $query->bindParam(':category_id', $_POST['category_id'], PDO::PARAM_INT);
        $query->execute(); return $query->fetchAll(PDO::FETCH_ASSOC);
    }