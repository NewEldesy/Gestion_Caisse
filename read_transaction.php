<?php
include_once('model.php');

$Recus = getT();
?>

<div class="col-md-12 order-md-1">
   <h5 class="mb-5">Liste des Transactions</h5>
   <div class="table-responsive">
      <table id="transactionTable" class="table table-striped table-sm">
         <thead>
            <tr>
               <th>#</th>
               <th>Date</th>
               <th>Total</th>
               <th>Statut</th>
               <th>Options</th>
            </tr>
         </thead>
         <tbody>
            <?php if (!empty($Recus)) {
                  foreach ($Recus as $Recu) { ?>
            <tr>
               <td><?= $Recu['id']; ?></td>
               <td><?= $Recu['date']; ?></td>
               <td><?= $Recu['total']; ?></td>
               <td><?= $Recu['statuts']; ?></td>
               <td>
                  <a href="#" id="btn_up_t" data-bs-toggle="modal" data-bs-target="#exampleModalMaj" data-id="<?= $Recu['id']; ?>" class="btn btn-sm btn-warning"></i>Modifier</a>
               </td>
            </tr>
            <?php } 
               } else { ?>
                  <tr>
                     <td colspan="3" class="text-center">
                        <div class="alert alert-warning" role="alert">
                           Pas de transactions effectuées
                        </div>
                     </td>
                  </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>

<script> new DataTable('#transactionTable'); </script>