<?php ob_start() ?>

<h1><?= $msg ?></h1>

<?php 
    $titre = "<?= $msg ?>";
    $content = ob_get_clean(); // Le buffer se remplis du contenu présent entre les deux balies 
    require "template.php";

?>