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
    $logDir = 'logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    $logFile = $logDir . '/db_errors.log';
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = "[" . $timestamp . "] " . $errorMessage . PHP_EOL;
    file_put_contents($logFile, $logMessage, FILE_APPEND);

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Error</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 40px; }
        .error-container { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 20px; border-radius: 5px; display: inline-block; }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Erreur de Base de Données</h1>
        <p>Une erreur s'est produite lors de l'accès à la base de données. Veuillez réessayer plus tard ou contacter l'administrateur si le problème persiste.</p>
    </div>
</body>
</html>
HTML;
    exit;
}
function deleteRecord($table, $idColumn, $id) { // Fonctions pour supprimer un enregistrement d'une table spécifique
    $database = dbConnect();
    $stmt = $database->prepare("DELETE FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); $stmt->execute();
}
function getById($table, $idColumn, $id) { // Fonctions pour obtenir un enregistrement par ID à partir d'une table spécifique
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Fonctions pour ajouter des enregistrements à différentes tables
function addCat($data) {
    $database = dbConnect(); $query = ("INSERT INTO categories (nom) VALUES (:nom)");
    $stmt = $database->prepare($query); $stmt->bindValue(":nom", $data['nom']);
    $stmt->execute();
}
function addProd($data) {
    $database = dbConnect(); $query = ("INSERT INTO produits (nom, prix, categorie_id, img) VALUES (:nom, :prix, :categorie_id, :img)");
    $stmt = $database->prepare($query); $stmt->bindValue(":nom", $data['nom']); $stmt->bindValue(":prix", $data['prix']);
    $stmt->bindValue(":categorie_id", $data['categorie_id']); $stmt->bindValue(":img", $data['img']); $stmt->execute();
}
// Fonctions pour lire des enregistrements dans différentes tables
function getCats() { 
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM categories");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getProducts() { 
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM produits");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getT() {
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM transactions");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// D'autres fonctions spécifiques pour obtenir des enregistrements par ID pour différentes tables
function getProduitById($id) { return getById('produits', 'id', $id); }
function getCatById($id) { return getById('categories', 'id', $id); }
function getTById($id) { return getById('transactions', 'id', $id); }
// Fonctions pour supprimer des enregistrements de différentes tables
function removeCat($id) { deleteRecord('categories', 'id', $id); }
function removeProd($id) { deleteRecord('produits', 'id', $id); }
// Fonctions pour mettre à jour des enregistrements dans différentes tables
function updateCat($data) {
    $database = dbConnect(); $query = ("UPDATE categories SET nom = :nom WHERE id = :id");
    $stmt = $database->prepare($query); $stmt->bindValue(":nom", $data['nom']);
    $stmt->bindValue(":id", $data['id'], PDO::PARAM_INT); $stmt->execute();
}
function updateProd($data) {
    $database = dbConnect(); $query = ("UPDATE produits SET nom = :nom, prix=:prix, categorie_id=:categorie_id, img=:img WHERE id = :id");
    $stmt = $database->prepare($query); $stmt->bindValue(":nom", $data['nom']); $stmt->bindValue(":prix", $data['prix']);
    $stmt->bindValue(":categorie_id", $data['categorie_id']); $stmt->bindValue(":img", $data['img']);
    $stmt->bindValue(":id", $data['id'], PDO::PARAM_INT); $stmt->execute();
}
function updateT($data) {
    $database = dbConnect(); $query = ("UPDATE transactions SET statuts = :statuts WHERE id = :id");
    $stmt = $database->prepare($query); $stmt->bindValue(":statuts", $data['statuts']);
    $stmt->bindValue(":id", $data['id'], PDO::PARAM_INT); $stmt->execute();
}
function getProdByCatId($categoryId){
    $database = dbConnect();
    $query = $database->prepare('SELECT * FROM produits WHERE categorie_id = :category_id');
    $query->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    $query->execute(); return $query->fetchAll(PDO::FETCH_ASSOC);
}
// Last Transaction Id
function lastId() {
    $database = dbConnect();
    $querylastId =  ("SELECT MAX(id) AS last_id FROM transactions");
    $stmt= $database->prepare($querylastId); $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); return $row['last_id'];
}
function getTotalTransactions($startDate, $endDate) {
    $database = dbConnect();
    $query = "SELECT SUM(total) AS total FROM transactions WHERE statuts = 'payé' AND date BETWEEN :startDate AND :endDate";
    $stmt = $database->prepare($query);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ? $result['total'] : 0;
}
function getTransactionTotals() {
    $today = date('Y-m-d'); $startOfWeek = date('Y-m-d', strtotime('monday this week'));
    $startOfMonth = date('Y-m-01'); $startOfYear = date('Y-01-01');
    $totals = [
        'today' => getTotalTransactions($today, $today), 'week' => getTotalTransactions($startOfWeek, $today),
        'month' => getTotalTransactions($startOfMonth, $today), 'year' => getTotalTransactions($startOfYear, $today),
        'total' => getTotalTransactions('1970-01-01', $today), // Start date from the epoch
    ];
    return $totals;
}

function getUserByUsername($username) {
    $database = dbConnect();
    if (!$database) {
        // dbConnect will call handleDatabaseError and exit, but good practice to check
        return false; 
    }
    try {
        $stmt = $database->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Returns user array or false if not found
    } catch (PDOException $e) {
        // Log error, but don't expose details to user-facing login process
        error_log("Database error in getUserByUsername: " . $e->getMessage());
        // It's crucial that handleDatabaseError in dbConnect logs details and shows a generic page.
        // For login, we just want to indicate failure, not necessarily halt everything with a generic DB error page
        // if the table or specific query fails for some reason other than connection.
        return false; 
    }
}