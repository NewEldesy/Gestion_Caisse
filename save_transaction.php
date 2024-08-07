<?php
include_once('model.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    // Assurez-vous que $data est bien formaté
    if (isset($data['transaction_id']) && isset($data['date']) && isset($data['total']) && isset($data['items']) && isset($data['statuts'])) {
        $transactionId = addTransaction($data);
        echo "Transaction ajoutée avec succès";
    } else {
        echo "Données manquantes.";
    }
}

function addTransaction($data) {
    $database = dbConnect();
    
    $transactionId = $data['transaction_id'];
    $date = $data['date'];
    $total = $data['total'];
    $statuts = $data['statuts']; // Récupérer le statut
    $items = json_decode($data['items'], true); // Décoder le JSON des éléments
    
    $database->beginTransaction(); // Début de la transaction
    
    // Requête pour insérer les données dans la table `transactions`
    $queryFacture = "INSERT INTO transactions (id, date, total, statuts) VALUES (:id, :date, :total, :statuts)";
    $stmtFacture = $database->prepare($queryFacture);
    $stmtFacture->bindParam(':id', $transactionId);
    $stmtFacture->bindParam(':date', $date);
    $stmtFacture->bindParam(':total', $total);
    $stmtFacture->bindParam(':statuts', $statuts);
    $stmtFacture->execute();

    // Requête pour insérer les éléments de la facture dans la table `transaction_details`
    $queryElementFacture = "INSERT INTO transaction_details (transaction_id, produit_id, quantite, total) VALUES (:transaction_id, :produit_id, :quantite, :total)";
    $stmt = $database->prepare($queryElementFacture);

    // Boucle pour insérer chaque élément de la facture
    foreach ($items as $element) {
        $produitId = getProduitIdByName($element['id']);
        if ($produitId) {
            $stmt->bindParam(':transaction_id', $transactionId);
            $stmt->bindParam(':produit_id', $produitId);
            $stmt->bindParam(':quantite', $element['qty']);
            $stmt->bindParam(':total', $element['total']);
            $stmt->execute();
        }
    }

    $database->commit(); // Valider la transaction
}

// Fonction pour obtenir l'ID du produit par son nom
function getProduitIdByName($nom) {
    $database = dbConnect();
    $query = "SELECT id FROM produits WHERE nom = :nom"; $stmt = $database->prepare($query);
    $stmt->bindParam(':nom', $nom); $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); return $result['id'];
}
?>