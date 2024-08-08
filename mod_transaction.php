<?php
include ("model.php");

$modif = $_POST['id'];

$mod = getTById($modif);

if (!empty($mod)) {
?>
<form id="frm_maj_prod" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-12 mb-3">
            <input type="hidden" value="<?=$mod['id']?>" class="form-control" id="id">
            <label for="statuts">Statut Reçu</label>
            <select class="form-select" id="statuts" aria-label="Floating label select example">
                <option value="payé" <?= ($mod['statuts'] == "payé") ? 'selected' : ''; ?>>payé</option>
                <option value="annulé" <?= ($mod['statuts'] == "annulé") ? 'selected' : ''; ?>>annulé</option>
            </select>
        </div>
    </div>
</form>
<?php } ?>