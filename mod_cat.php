<?php
include ("model.php");

$modif = $_POST['id'];

$mod = getCatById($modif);

if (!empty($mod)) {
?>
<form id="frm_maj_cat" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-12 mb-3">
            <input type="hidden" value="<?php echo $mod['id'] ?>" class="form-control" id="id" placeholder="" required>
            <label for="nom">Nom</label>
            <input type="text" value="<?php echo $mod['nom'] ?>" class="form-control" id="nom" placeholder="" required>
        </div>
    </div>
</form>
<?php } ?>