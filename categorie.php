<?php 
    session_start();
    include_once('model.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Caisse</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
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

    <div class="container-fluid">
        <hr>
        <div class="row">
            <div class="col-xl-6">
                <table class="table table-borderless table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col" class="action-col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cats = getCats();
                            foreach($cats as $cat){
                        ?>
                            <tr>
                                <td><?=$cat['id'];?></td>
                                <td><?=$cat['nom'];?></td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/font-awesome/js/all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jQuery.print.js"></script>

</body>
</html>