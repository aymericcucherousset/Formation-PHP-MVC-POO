<?php 

require_once "models/Livre.php";
require_once "models/Model.php";

class LivreManager extends Model
{
    private array $livres;

    public function ajoutLivre(Livre $livre):void
    {
        $this->livres[] = $livre;
    }
    public function getLivres():array
    {
        return $this->livres;
    }
    public function chargementLivres()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM livres ORDER BY id DESC");
        $req->execute();

        $mesLivres = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        foreach ($mesLivres as $livre) {
            $this->ajoutLivre(new Livre($livre['id'], $livre['titre'], $livre['nbPages'], $livre['image']));
        }
    }
    public function getLivreById(int $id_livre):Livre
    {
        foreach ($this->livres as $livre) {
            if ($livre->getId() === $id_livre) {
                return $livre;
            }
        }
        throw new Exception("Erreur : Cette page n'éxiste pas !");
    }
    public function ajoutLivreBd($titre, $nbPages, $image)
    {
        $req = "INSERT INTO livres (titre, nbPages, image)
                values (:titre, :nbPages, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $livre = new Livre($this->getBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajoutLivre($livre);
        }
    }
    public function suppressionLivreBD($id)
    {
        $req = "
            DELETE FROM livres WHERE id = :idLivre
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idLivre", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $livre = $this->getLivreById($id);
            unset($livre);
        }
    }
    public function modificationLivreBD($id, $titre, $nbPages, $image){
        $req = "
            UPDATE livres
            SET titre = :titre, nbPages = :nbPages, image = :image
            WHERE id = :id
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":titre", $titre , PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image , PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $this->getLivreById($id)->setTitre($titre);
            $this->getLivreById($id)->setNbPages($nbPages);
            $this->getLivreById($id)->setImage($image);
        }
    }
}