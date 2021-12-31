<?php
session_start();
define("URL", str_replace("index.php", "", isset($_SERVER['HTTPS']) ? 'https' : 'http' . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));


require_once "controllers/livresController.controller.php";
$livresControlleur = new LivresController();

try {
    if(empty($_GET['page'])){
        require "views/accueil.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case 'accueil': require "views/accueil.view.php";
            break;
            case 'livres': 
                if(empty($url[1])){
                    $livresControlleur->afficherLivres();
                } else {
                    switch ($url[1]) {
                        case 'lecture': $livresControlleur->afficherLivre($url[2]);
                        break;
                        case 'modification-livre': $livresControlleur->modificationLivre($url[2]);
                        break;
                        case 'modification-livre-validation': $livresControlleur->modificationLivreValidation();
                        break;
                        case 'supprimer-livre': $livresControlleur->suppressionLivre($url[2]);
                        break;
                        case 'ajout': $livresControlleur->ajoutLivre();
                        break;
                        case 'ajout-livre-validation': $livresControlleur->ajoutLivreValidation();
                        break;
                        default: throw new Exception("Erreur : Cette page n'éxiste pas !");
                        break;
                    }
                }
                break;
            default:
                throw new Exception("Erreur : Cette page n'éxiste pas !");
                break;
        }
    }
} catch (Exception $e) {
    $msg =  $e->getMessage();
    require "views/error.view.php";
}

?>