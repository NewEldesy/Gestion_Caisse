<?php include_once('model.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>GC || Produits</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <!-- <link href="dashboard.css" rel="stylesheet"> -->
    </head>

    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Gestion Caisse</a>
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
                        <h3 class="h3">Produits</h3>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <a href="#" id="addProd" data-bs-toggle="modal" data-bs-target="#exampleModalAdd" class="btn btn-sm btn-outline-primary">
                                    Nouveau Produit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="result_prod"></div>
                    <div id="msg_delete_prod"></div>
                    <div id="msg_maj_prod"></div>

                    <div id="affProd"></div>
                </main>

            </div>
        </div>
    
        <!-- Fenetre de Modification des departements -->
        <div class="modal fade" id="exampleModalMaj" tabindex="-1" aria-labelledby="UpdateModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateModal">Modifier Utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <div id="aff_form_mod"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_maj_prod" class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Fenetre de Modification des departements -->
        <div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="AddModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddModal">Ajout Produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <form  id="frm_add_prod" class="needs-validation" novalidates enctype="multipart/form-data">
                            <label for="nom">Nom</label>
                            <input class="form-control" type="text" name="nom" id="nom" required>
                            <label for="prix">Prix</label>
                            <input class="form-control" type="text" name="prix" id="prix" required>
                            <label for="categorie_id" class="form-label">Sélectionnez une categorie</label>
                                    <select class="form-select" name="categorie_id" id="categorie_id" aria-label="Floating label select example">
                                        <?php $cats = getCats();
                                            foreach($cats as $cat) {
                                        ?>
                                        <option value="<?=$cat['id'];?>"><?=$cat['nom'];?></option>
                                        <?php } ?>
                                    </select>
                            <label for="img">Image</label>
                            <input class="form-control" type="file" name="img" id="img" accept=".png, .jpg, .jpeg" required>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_add_prod" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>