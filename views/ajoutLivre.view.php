<?php ob_start() ?>

<form method="POST" action="<?= URL ?>livres/ajout-livre-validation" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre : </label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="mb-3">
        <label for="nbPages" class="form-label">Nombre de pages : </label>
        <input type="number" class="form-control" id="nbPages" name="nbPages">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image :</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php
$titre = "Ajout d'un livre";
$content = ob_get_clean();
require "template.php";
?>