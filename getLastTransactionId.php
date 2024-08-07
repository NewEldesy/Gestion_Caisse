<?php
    include_once('model.php');

    header('Content-Type: application/json'); // Assurez-vous que le type de contenu est défini comme JSON

    $n = lastId();
    $lastId = $n + 1;

    // Retourner le résultat en JSON
    echo json_encode(['success' => true, 'last_id' => $lastId]);
?>