<?php 
ob_start();

if (!empty($_SESSION['alert'])) { ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
        <?= $_SESSION['alert']['msg'] ?>
    </div>
    <?php 
    unset($_SESSION['alert']);

} ?>


<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de page</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php foreach ($livres as $livre) { ?>
        <tr>
            <td class="align-middle"><img src="public/img/<?= $livre->getImage() ?>" width="60px"></td>
            <td class="align-middle"><a href="<?= URL ?>livres/lecture/<?= $livre->getId() ?>"><?= $livre->getTitre() ?></a></td>
            <td class="align-middle"><?= $livre->getNbpages() ?></td>
            <td class="align-middle"><a href="<?= URL."/livres/modification-livre/". $livre->getId() ?>" class="btn btn-warning">Modifier</a></td>
            <td class="align-middle">
                <form action="<?= URL . 'livres/supprimer-livre/' . $livre->getId() ?>" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer le livre ?');">
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
<a href="<?= URL ?>livres/ajout" class="btn btn-success d-block">Ajouter</a>

<?php
$titre = "Les livres de la bibliothèque";
$content = ob_get_clean();
require "template.php";
?>