<?php ob_start() ?>

<form method="POST" action="<?= URL ?>livres/modification-livre-validation" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre : </label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $livre->getTitre() ?>">
    </div>
    <div class="mb-3">
        <label for="nbPages" class="form-label">Nombre de pages : </label>
        <input type="number" class="form-control" id="nbPages" name="nbPages" value="<?= $livre->getNbPages() ?>">
    </div>
    <h3>Image : </h3>
    <img src="<?= URL . 'public/img/' . $livre->getImage() ?>"  alt="">
    <div class="mb-3">
        <label for="image" class="form-label">Changer l'image :</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <input type="hidden" name="id" value="<?= $livre->getId() ?>">
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>


<?php 
    $titre = "Modification du livre : ".$livre->getTitre();
    $content = ob_get_clean(); // Le buffer se remplis du contenu présent entre les deux balies 
    require "template.php";

?>