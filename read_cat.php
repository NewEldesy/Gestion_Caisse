<?php
include_once('model.php');

$cats = getCats();
?>

<div class="col-md-12 order-md-1">
   <h5 class="mb-5">Liste des categories</h5>
   <div class="table-responsive">
      <table class="table table-striped table-sm">
         <thead>
            <tr>
               <th>#</th>
               <th>Nom</th>
               <th>Options</th>
            </tr>
         </thead>
         <tbody>
            <?php if (!empty($cats)) {
                  foreach ($cats as $cat) { ?>
            <tr>
               <td><?= $cat['id']; ?></td>
               <td><?= $cat['nom']; ?></td>
               <td>
                    <a href="#" id="btn_del_cat" value="<?= $cat['id']; ?>" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>Supprimer
                    </a>
                    <a href="#" id="btn_up_cat" data-bs-toggle="modal" data-bs-target="#exampleModalMaj" value="<?= $cat['id']; ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>Modifier
                    </a>
               </td>
            </tr>
            <?php } 
               } else { ?>
                  <tr>
                     <td colspan="3" class="text-center">
                        <div class="alert alert-warning" role="alert">
                           Pas de catégories disponible
                        </div>
                     </td>
                  </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>