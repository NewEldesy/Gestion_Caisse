<?php 
    require_once('header.php');
?>

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
                                        <div id="msg_print"></div>
                                        <div class="facture" id="facture">
                                            <h1>Espace Régal</h1>
                                            <p><span id="date"></span></p>
                                            <p>Reçu n° : <span id="transaction_id"></span></p>
                                            
                                            <table class="table table-borderless table-secondary">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Prix Unit.</th>
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
                                            <div id="loading" style="display: none;">Traitement en cours...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>
                

                <!-- Start quantityModal Modal -->
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
                <!-- End quantityModal Modal -->
            </div>
        </div>
        
        <!-- JavaScript -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/jQuery.print.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>