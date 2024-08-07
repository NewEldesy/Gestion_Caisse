<?php include_once('model.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="B'Tech Group">

        <title>E.R || Transactions</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Espace Regal</a>
            <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
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
                        <h3 class="h3">Transactions</h3>
                    </div>

                    <!-- Start Dashboard -->
                    <?php $totals = getTransactionTotals(); ?>
                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">
                            <div class="col-sm col-xl">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Total Général</h6>
                                        <p class="mb-2"><?= number_format($totals['total'], 2) ?> F CFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Aujourd'hui</h6>
                                        <p class="mb-2"><?= number_format($totals['today'], 2) ?> F CFA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Cette semaine</h6>
                                        <p class="mb-2"><?= number_format($totals['week'], 2) ?> F CFA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Ce mois</h6>
                                        <p class="mb-2"><?= number_format($totals['month'], 2) ?> F CFA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Cette année</h6>
                                        <p class="mb-2"><?= number_format($totals['year'], 2) ?> F CFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Dashboard -->

                    <div id="msg_delete"></div>
                    <div id="msg_maj"></div>

                    <div id="affTransactions"></div>
                </main>

            </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>