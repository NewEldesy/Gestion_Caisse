<?php
function dbConnect() {
    try {
        $database = new PDO('sqlite:BDD/caisse.db');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage());
    }
}

function handleDatabaseError($errorMessage) {
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

function getAll($table) {
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM {$table}");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getById($table, $idColumn, $id) { // Fonctions pour obtenir un enregistrement par ID à partir d'une table spécifique
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonctions pour ajouter des enregistrements à différentes tables
function addCat($data) { addRecord('categories', $data); }

// Fonctions pour lire des enregistrements dans différentes tables
function getCats() { return getAll('categories'); }
function getProduits() { return getAll('produits'); }

// D'autres fonctions spécifiques pour obtenir des enregistrements par ID pour différentes tables
function getProduitById($id) { return getById('produits', 'id', $id); }