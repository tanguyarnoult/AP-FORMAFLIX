<?php

namespace models;

use models\base\SQL;
use utils\SessionHelpers;

class AccountModel extends SQL
{
    public function __construct()
    {
        parent::__construct('inscrit', 'IDINSCRIT');
    }

    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT=? LIMIT 1");
        $stmt->execute([$username]);
        $inscrit = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($inscrit !== false && password_verify($password, $inscrit['MOTPASSEINSCRIT'])) {
            SessionHelpers::login(array("username" => "{$inscrit["NOMINSCRIT"]} {$inscrit["PRENOMINSCRIT"]}", "email" => $inscrit["EMAILINSCRIT"]));
            return true;
        } else {
            SessionHelpers::logout();
            return false;
        }
    }

    public function register($nom, $prenom, $login, $password, $diplome){
        $stmt = $this->pdo->prepare("INSERT INTO inscrit VALUES (NULL, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $login, $password, $diplome]);
    }

    function getMaxIDDiplome(){
        $stmt = $this->pdo->prepare("SELECT MAX(IDDIPLOME) as MAX FROM diplome");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function getByDiplomeID($id){
        $stmt = $this->pdo->prepare("SELECT * FROM diplome WHERE IDDIPLOME =?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}