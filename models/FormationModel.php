<?php

namespace models;

use models\base\SQL;

class FormationModel extends SQL
{
    public function __construct()
    {
        parent::__construct('formation', "IDFORMATION");
    }

    function getPublicVideos()
    {
        $stmt = $this->pdo->query("SELECT * FROM formation where VISIBILITEPUBLIC = 1");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getVideos()
    {
        return $this->getAll();
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
}