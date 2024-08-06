<?php
include ("model.php");

$modif = $_POST['id'];

$mod = getProduitById($modif);

if (!empty($mod)) {
?>
<form id="frm_maj_prod" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-12 mb-3">
            <input type="hidden" value="<?=$mod['id'] ?>" class="form-control" id="id">
            <input type="hidden" value="<?=$mod['img']?>" class="form-control" id="current_img">
            <label for="nom">Nom</label>
            <input type="text" value="<?=$mod['nom'] ?>" class="form-control" id="nom" required>
            <label for="categorie_id">Sélectionnez une categorie</label>
            <select class="form-select" name="categorie_id" id="categorie_id" value="<?= $mod['categorie_id'];?>" aria-label="Floating label select example">
                <?php $cats = getCats();
                    foreach($cats as $cat) {
                ?>
                <option value="<?=$cat['id'];?>" <?=($mod['categorie_id']==$cat['id']) ? 'selected' : '';?>><?=$cat['nom'];?></option>
                <?php } ?>
            </select>
            <label for="prix">Prix</label>
            <input type="text" value="<?=$mod['prix'] ?>" class="form-control" id="prix" required>
            <label for="img">Image</label>
            <div>
                <!-- Affichage de l'image actuelle -->
                <img src="assets/img/<?=$mod['img']?>" alt="" class="img-thumbnail" width="50" height="50">
            </div>
            <input type="file" accept=".png, .jpg, .jpeg" id="img" class="form-control" required>
        </div>
    </div>
</form>
<?php } ?>