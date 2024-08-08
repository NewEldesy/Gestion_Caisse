<?php
require_once 'model.php'; // Incluez votre fichier model.php

// Récupération des totaux des transactions
$totals = getTransactionTotals();

// Retourner les totaux en JSON
header('Content-Type: application/json');
echo json_encode($totals);
?>