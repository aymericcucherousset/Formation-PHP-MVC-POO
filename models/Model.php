<?php

abstract class Model
{
    private static $pdo;

    /**
     * Construction de la connexion PDO
     */
    private static function setBdd():void
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=biblio;charset=utf8", 'root', '');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    /**
     * Appel la contruction de la connexion PDO si elle n'éxiste pas. Puis la retourne
     * @return PDO
     */
    protected function getBdd():PDO
    {
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}