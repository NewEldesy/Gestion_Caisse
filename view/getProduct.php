<?php
    include_once('model.php');
    
    $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : 1;

    // Requête pour récupérer les articles en fonction de la catégorie sélectionnée
    if ($categoryId == 1) {
        $prods = getAllProd();
    } else {
        $prods = getProdByCatId();
    }

    $items = '';

    // var_dump($prods);exit;
    foreach($prods as $prod) {
        $items .= '
        <div class="col">
            <div class="card" id="select">
                <img src="assets/img/' . htmlspecialchars($prod['img']) . '" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-title">'. $prod['nom'] .'</h5>
                    <p>Prix : <span class="prix">'. htmlspecialchars($prod['prix']) .'</span> F CFA</p>
                </div>
            </div>
        </div>';
    }

    echo $items;