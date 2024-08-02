<?php
function dbConnect() {
    try {
        // Connexion à la base de données SQLite
        $database = new PDO('sqlite:BDD/caisse.db');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage());
    }
}

function handleDatabaseError($errorMessage) { // Gestion des erreurs de base de données
    exit("Erreur de base de données : " . $errorMessage);
}

function addRecord($table, $data) { // Fonctions pour ajouter un nouvel enregistrement à une table spécifique
    $database = dbConnect();
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $stmt = $database->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    foreach ($data as $key => $value) { $stmt->bindValue(":{$key}", $value); }
    $stmt->execute();
}

// Fonctions pour ajouter des enregistrements à différentes tables
function addCat($data) { addRecord('categories', $data); }