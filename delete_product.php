<?php
include("model.php");

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    if(!removeProd($id)) {
        echo '<div class="alert alert-success" role="alert">Produit supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Échec de la suppression du Produit.</div>';
    }
} else {
    echo '<div class="alert alert-warning" role="alert">ID du Produit manquant.</div>';
}