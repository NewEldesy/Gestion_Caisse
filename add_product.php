<?php
    include_once('model.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            $fileType = $_FILES['img']['type'];
    
            if (in_array($fileType, $allowedTypes)) {
                $uploadDir = 'assets/img/';
                $uploadFile = $uploadDir . basename($_FILES['img']['name']);
                
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $data['nom'] = $_POST['nom'];
                    $data['prix'] = $_POST['prix'];
                    $data['categorie_id'] = $_POST['categorie_id'];
                    $data['img'] = $_FILES['img']['name'];
    
                    addProd($data);
    
                    echo '<div class="alert alert-success" role="alert">Produit ajouté avec succès</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'upload de l\'image</div>';
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">Type de fichier non autorisé. Veuillez télécharger une image au format PNG, JPG ou JPEG.</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">Veuillez sélectionner une image à télécharger.</div>';
        }
    }