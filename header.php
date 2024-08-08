<?php 
    session_start();
    require_once('model.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- title page -->
        <title>Espace Regale</title>
        <!-- CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="assets/dataTables/css/dataTables.dataTables.css" rel="stylesheet">
        <!-- Custom styles for print -->
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
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Espace Regal</a>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Deconnection</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                
                            </h6>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">
                                    Caisse
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="categorie.php">
                                Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produit.php">
                                Produits
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="transaction.php">
                                Transactions
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>