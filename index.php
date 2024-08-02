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
    <div class="container-fluid">
        <hr>
        <div class="mb-3">
            <?php $cats = getCats();
                foreach($cats as $cat){?>
            <button type="button" class="btn btn-primary cat-button" data-category="<?=$cat['id'];?>"><?=$cat['nom'];?></button>
            <?php }?>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8">
                <div class="row row-cols-5 g-3 item_cat">
                    <!-- <div class="col">
                        <div class="card">
                            <img src="assets/img/poulet.jpeg" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Poulet & alloco</h5>
                              <p>Prix : <span class="prix">2000</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/attieke.jpeg" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Attiéké Poisson</h5>
                              <p>Prix : <span class="prix">1000</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="assets/img/exemple.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                              <h5 class="card-title">Article</h5>
                              <p>Prix : <span class="prix">100</span> F CFA</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-4">
                <div class="col border border border-secondary border rounded p-4">
                    <div class="facture" id="facture">
                        <h1>Restaurant</h1>
                        <p>01 Août 2024</p>
                        <p>Reçu n° : 1</p>
                        
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
                        <input type="button" class="btn btn-primary" id="print" onclick="imprimerFacture()" value="Imprimer">
                    </div>
                </div>
            </div>
        </div>
    </div>

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


    <!-- Javascript -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/font-awesome/js/all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jQuery.print.js"></script>

    <!-- Add To Table -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tableauRecu = [];
            let selectedCard = null; // Variable pour stocker la carte sélectionnée
            const modalElement = document.getElementById('quantityModal');
            const modal = new bootstrap.Modal(modalElement);

            // Utiliser la délégation d'événements pour les éléments ajoutés dynamiquement
            document.body.addEventListener('click', function(event) {
                if (event.target.closest('.card')) {
                    selectedCard = event.target.closest('.card'); // Stocker la carte sélectionnée
                    modal.show(); // Afficher le modal
                }
            });

            document.getElementById('confirmQuantity').addEventListener('click', function() {
                let quantite = parseInt(document.getElementById('quantityInput').value);
                let titre = selectedCard.querySelector('.card-title').textContent;
                let prix = parseFloat(selectedCard.querySelector('.prix').textContent);

                let articleExiste = false;
                tableauRecu.forEach(function(item) {
                    if (item.nom === titre) {
                        item.quantite = quantite;
                        articleExiste = true;
                    }
                });

                if (!articleExiste) {
                    tableauRecu.push({ nom: titre, prix: prix, quantite: quantite });
                }

                afficherRecu(tableauRecu);
                modal.hide(); // Masquer le modal
            });

            function afficherRecu(tableau) {
                let recuElement = document.getElementById('recu');
                recuElement.innerHTML = '';
                let total = 0;

                tableau.forEach(function(item, index) {
                    recuElement.innerHTML += `<tr>
                        <td>${item.nom}</td>
                        <td>${item.quantite}</td>
                        <td>${item.prix}</td>
                        <td>${(item.prix * item.quantite)}</td>
                        <td class="action-col"><button class="btn btn-danger btn-sm" onclick="supprimerArticle(${index})"><i class="fas fa-trash"></i></button></td>
                    </tr>`;
                    total += item.prix * item.quantite;
                });

                document.getElementById('total').textContent = total;
            }

            window.supprimerArticle = function(index) {
                tableauRecu.splice(index, 1);
                afficherRecu(tableauRecu);
            };
        });
    </script>

    <script>
        $(function(){
            $('#print').on('click', function(){
                $('.action-col').hide(); // colonne "Action" invisible avant impression
                $.print(".facture"); // Imprimer la facture
                $('.action-col').show(); // colonne "Action" visible après impression
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Charger tous les articles au chargement de la page
            loadItems(1);

            // Gérer le clic sur les boutons de catégorie avec la classe spécifique
            $('.cat-button').click(function() {
                var categoryId = $(this).data('category'); // Utiliser l'attribut data-category
                loadItems(categoryId);
            });

            // Fonction pour charger les articles en fonction de la catégorie
            function loadItems(categoryId) {
                $.ajax({
                    url: 'view/getProduitByCatId.php',
                    type: 'POST',
                    data: { category_id: categoryId },
                    success: function(response) {
                        $('.item_cat').html(response);
                    }
                });
            }
        });
    </script>

</body>
</html>

<?php ob_end_flush(); ?>