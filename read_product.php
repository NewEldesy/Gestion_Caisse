<?php
include_once('model.php');

$prods = getProducts();
?>

<div class="col-md-12 order-md-1">
   <h5 class="mb-5">Liste des prodegories</h5>
   <div class="table-responsive">
      <table id="productTable" class="table table-striped table-sm">
         <thead>
            <tr>
               <th>#</th>
               <th>Nom</th>
               <th>Prx</th>
               <th>img</th>
               <th>Options</th>
            </tr>
         </thead>
         <tbody>
            <?php if (!empty($prods)) {
                  foreach ($prods as $prod) { ?>
            <tr>
               <td><?= $prod['id']; ?></td>
               <td><?= $prod['nom']; ?></td>
               <td><?= $prod['prix']; ?></td>
               <td><img src="assets/img/<?=$prod['img'];?>" alt="" width="40" height="40"></td>
               <td>
                  <a href="#" class="btn_del_prod btn btn-sm btn-danger" data-id="<?=$prod['id'];?>">Supprimer</a>
                  <a href="#" id="btn_up_prod" data-bs-toggle="modal" data-bs-target="#exampleModalMaj" value="<?= $prod['id']; ?>" class="btn btn-sm btn-warning"></i>Modifier</a>
               </td>
            </tr>
            <?php } 
               } else { ?>
                  <tr>
                     <td colspan="3" class="text-center">
                        <div class="alert alert-warning" role="alert">
                           Pas de produits disponible
                        </div>
                     </td>
                  </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>