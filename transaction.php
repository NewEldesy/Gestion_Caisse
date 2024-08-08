<?php include_once('header.php'); ?>

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
                                        <p class="mb-2"><span id="t_total"></span> F CFA</p>
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
                                        <p class="mb-2"><span id="t_today"></span> F CFA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Cette semaine</h6>
                                        <p class="mb-2"><span id="t_week"></span> F CFA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Ce mois</h6>
                                        <p class="mb-2"><span id="t_month"></span> F CFA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                                    <div class="ms-3">
                                        <h6 class="mb-0">Cette année</h6>
                                        <p class="mb-2"><span id="t_year"></span> F CFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="msg_maj_t"></div>

                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">
                            <div class="col-sm col-xl">
                                <div id="affTransactions"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Dashboard -->

                    <!-- Modal Modification Transactions -->
                    <div class="modal fade" id="exampleModalMaj" tabindex="-1" aria-labelledby="UpdateModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="UpdateModal">Modifier Transactions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" >
                                    <div id="aff_form_t"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btn_maj_t" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Modification Transactions -->
                </main>
            </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/dataTables/js/dataTables.js"></script>
    </body>
</html>