<?php
include("model.php");

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    if(!removeCat($id)) {
        echo '<div class="alert alert-success" role="alert">Catégorie supprimée avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Échec de la suppression de la catégorie.</div>';
    }
} else {
    echo '<div class="alert alert-warning" role="alert">ID de la catégorie manquant.</div>';
}