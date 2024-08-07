<?php 
    session_start();
    include_once('model.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- title page -->
        <title>E.R || Caisse</title>
        <!-- CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
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

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h3 class="h3">Caisse</h3>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <?php $cats = getCats();
                                foreach($cats as $cat){?>
                            <button type="button" class="btn btn-primary me-2 cat-button" data-category="<?=$cat['id'];?>"><?=$cat['nom'];?></button>
                            <?php }?>
                        </div>
                        <hr>
                            <div id="msg_print"></div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="row row-cols-5 g-3 item_cat">
                                        <!-- Product list -->
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="col border border border-secondary border rounded p-4">
                                        <div id="error"></div>
                                        <div class="facture" id="facture">
                                            <h1>Restaurant</h1>
                                            <p><span id="date"></span></p>
                                            <p>Reçu n° : <span id="transaction_id"></span></p>
                                            
                                            <table class="table table-borderless table-secondary">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">P.U</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col" class="action-col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="recu">
                                                    <!-- Les lignes de tableau seront ajoutées dynamiquement ici -->
                                                </tbody>
                                            </table>
                                            <p class="text-end"><strong>Total: <span id="total"></span> F CFA</strong></p>
                                        </div>
                                        <div class="col d-flex justify-content-center">
                                            <input type="button" class="btn btn-primary" id="print" value="Imprimer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>
                

                <!-- Start Modal -->
                <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Quantité</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="number" id="quantityInput" value="1" min="1">
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="confirmQuantity" class="btn btn-primary">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            </div>
        </div>
        
        <!-- JavaScript -->
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/jQuery.print.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>