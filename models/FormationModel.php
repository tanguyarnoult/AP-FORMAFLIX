<?php

namespace models;

use models\base\SQL;

class FormationModel extends SQL
{
    public function __construct()
    {
        parent::__construct('formation', "IDFORMATION");
    }

    // Ajout de la condition "DATEVISIBILITE < NOW" pour n'afficher que les vidéos avec une date de visibilité antérieure

    function getPublicVideos()
    {
        $stmt = $this->pdo->query("SELECT * FROM formation where VISIBILITEPUBLIC = 1 AND DATEVISIBILITE < NOW()");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Modification de getVideos() pour pouvoir afficher uniquement les vidéos avec une date de visibilité antérieure

    function getVideos()
    {
        $stmt = $this->pdo->query("SELECT * FROM formation WHERE DATEVISIBILITE < NOW()");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getByVideoId($videoId)
    {
        // Utilisation d'une query a la place d'un simple getOne car la requête
        // est réalisé sur un champs différent que l'ID de la table.

        $stmt = $this->pdo->prepare("SELECT * FROM formation WHERE IDENTIFIANTVIDEO = ?");
        $stmt->execute([$videoId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function competencesFormation($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM competence LEFT JOIN developper d on competence.IDCOMPETENCE = d.IDCOMPETENCE WHERE d.IDFORMATION = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getMaxIDCompetence(){
        $stmt = $this->pdo->prepare("SELECT MAX(IDCOMPETENCE) AS MAXIDCOMP FROM competence");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function getCompetenceByID($id){
        $stmt = $this->pdo->prepare("SELECT * FROM competence WHERE IDCOMPETENCE =?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    // Recherche les vidéos liées à une compétence si l'utilisateur n'est pas connecté
    function getAllVideosByCompetence($idCompetence)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation NATURAL JOIN developper WHERE DATEVISIBILITE < NOW() AND IDCOMPETENCE =? AND VISIBILITEPUBLIC = 1");
        $stmt->execute([$idCompetence]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Recherche les vidéos liées à une compétence
    function getVideosByCompetence($idCompetence)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation NATURAL JOIN developper WHERE DATEVISIBILITE < NOW() AND IDCOMPETENCE =?");
        $stmt->execute([$idCompetence]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getCommentaireByFormationID($id){
        $stmt = $this->pdo->prepare("SELECT * FROM commentaire NATURAL JOIN inscrit WHERE IDFORMATION =? AND VALIDATION=1");
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getFormationByVideoID($id){
        $stmt = $this->pdo->prepare("SELECT * FROM formation WHERE IDENTIFIANTVIDEO =?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Récupère l'ID d'un inscrit par son email
    function getIDUserByEmail($email){
        $stmt = $this->pdo->prepare("SELECT IDINSCRIT FROM inscrit WHERE EMAILINSCRIT =?");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Ajoute un commentaire
    function addCommentaire($libelle, $email, $formation){
        $id = $this->getIDUserByEmail($email);
        $id = $id["IDINSCRIT"];

        $stmt = $this->pdo->prepare("INSERT INTO commentaire VALUES(?,?,?, NOW(), 0)");
        $stmt->execute([$id, $formation, $libelle]);
    }

    // Savoir si un utilisateur possède la certification sur une formation

    // On récupère la ceritication de la formation

    function getCertificationByFormationID($idFormation){
        $stmt = $this->pdo->prepare("SELECT IDCERTIFICATION FROM formation WHERE IDFORMATION = ?");
        $stmt->execute([$idFormation]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function estCertifie($idCertification, $idUtilisateur)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM certifie WHERE IDCERTIFICATION = ? AND IDINSCRIT = ?");
        $stmt->execute([$idCertification, $idUtilisateur]);
        $reponse = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (isset($reponse["IDINSCRIT"])) {
            return true;
        } else {
            return false;
        }
    }

    function supprimerCertifie($idCertification, $idUtilisateur){
        $stmt = $this->pdo->prepare("DELETE FROM certifie WHERE IDCERTIFICATION = ? AND IDINSCRIT = ?");
        $stmt->execute([$idCertification, $idUtilisateur]);
    }

    function ajouterCertifie($idCertification, $idUtilisateur){
        $stmt = $this->pdo->prepare("INSERT INTO certifie VALUES(?,?)");
        $stmt->execute([$idUtilisateur, $idCertification]);
    }

}