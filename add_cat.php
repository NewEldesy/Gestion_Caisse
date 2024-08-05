<?php
    include_once('model.php');

    include_once('model.php');

    if(isset($_POST['nom']) && !empty($_POST['nom'])) {
        $data = ['nom' => $_POST['nom']];
        $cat = addCat($data);
        
        if($cat){
            echo '<div class="alert alert-success" role="alert">Catégorie ajoutée avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Échec de l\'ajout de la catégorie.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Le champ est vide, veuillez remplir le nom de la catégorie.</div>';
    }