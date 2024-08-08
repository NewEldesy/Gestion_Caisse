<?php
include_once('model.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // L'identifiant du produit à mettre à jour
    
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
        $fileType = $_FILES['img']['type'];
        
        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = 'assets/img/';
            $uploadFile = $uploadDir . basename($_FILES['img']['name']);
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                $imgName = $_FILES['img']['name'];
            } else {
                echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'upload de l\'image</div>';
                exit;
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">Type de fichier non autorisé. Veuillez télécharger une image au format PNG, JPG ou JPEG.</div>';
            exit;
        }
    } else {
        $imgName = $_POST['current_img']; // Conserve l'image actuelle si aucune nouvelle image n'est téléchargée
    }

    $data = [
        'id' => $id,
        'nom' => $_POST['nom'],
        'prix' => $_POST['prix'],
        'categorie_id' => $_POST['categorie_id'],
        'img' => $imgName
    ];

    $update = updateProd($data);

    if (!$update) {
        echo '<div class="alert alert-success" role="alert">Produit mis à jour avec succès</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Échec de la mise à jour du produit</div>';
    }
}