<?php ob_start() ?>

<p>Le contenu de la page d'accueil</p>

<?php 
    $titre = "Bibliothèque";
    $content = ob_get_clean(); // Le buffer se remplis du contenu présent entre les deux balies 
    require "template.php";

?>