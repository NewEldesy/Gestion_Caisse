<?php 
    session_start();
    include_once('/model.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Caisse</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .facture {
                width: 80mm; /* Largeur de la facture en millimètres */
                margin: 0 auto; /* Centrer la facture sur la page */
                padding: 10mm; /* Ajouter du padding autour de la facture */
            }
            body * {
                visibility: hidden;
            }
            .facture, .facture * {
                visibility: visible;
            }
            .facture {
                position: absolute;
                left: 0;
                top: 0;
            }
            .action-col {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <ul class="nav col-12 col-md-12 mb-2 justify-content-center mb-md-0">
                <li><a href="index" class="nav-link px-2 link-secondary">Acceuil</a></li>
                <li><a href="page/categorie.php" class="nav-link px-2">Catégories</a></li>
                <li><a href="page/produit.php" class="nav-link px-2">Produits</a></li>
                <li><a href="page/transaction.php" class="nav-link px-2">Transactions</a></li>
            </ul>
        </header>
    </div>