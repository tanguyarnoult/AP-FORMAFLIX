<?php

namespace controllers;

use controllers\base\Web;
use models\CompetenceModel;
use models\FormationModel;
use utils\SessionHelpers;

/**
 * Contrôleur des formations
 * Affichage de la liste des formations.
 */
class Formation extends Web
{
    private $formationModel;

    function __construct()
    {
        $this->formationModel = new FormationModel();
    }

    // Affichage de la page d'accueil avec en fonction si connecté ou non une liste plus complète.
    function home()
    {

        // Mise en variable de MAX(IDCOMPETENCE) FROM competence pour créer une boucle for
        $max = $this->formationModel->getMaxIDCompetence();
        $max = $max["MAXIDCOMP"];


        // Mise en tableau de toutes les compétences
        $competences = [];


        for($i=1; $i<=$max; $i++) {
            $competence = $this->formationModel->getCompetenceByID($i);

            if(isset($competence)){
                array_push($competences, $competence);
            }

        }

        $formations = [];
        if (SessionHelpers::isLogin()) {
            // Si une compétence à été sélectionnée par l'utilisateur
            if(isset($_GET["competence"]) && $_GET["competence"] != 0) {
                $formations = $this->formationModel->getVideosByCompetence($_GET["competence"]);
            } else{
                $formations = $this->formationModel->getVideos();
            }
        } else {
            if(isset($_GET["competence"]) && $_GET["competence"] != 0){
                $formations = $this->formationModel->getAllVideosByCompetence($_GET["competence"]);
            } else {
                $formations = $this->formationModel->getPublicVideos();
            }

        }

        $this->header();
        include("./views/formation/list.php");
        $this->footer();
    }

    /**
     * $id est automatiquement rempli via la valeur du GET
     * @param $id
     */

    function tv($id)
    {

        // Récupération de la vidéo par rapport à l'ID demandé
        $video = $this->formationModel->getByVideoId($id);
        if (!$video) {
            $this->redirect("./formations");
        }



        // Les vidéos non public ne doivent pas être visible si non connecté
        if($video['VISIBILITEPUBLIC'] == 0 && !SessionHelpers::isLogin()){
            $this->redirect("./formations");
        }

        // Verifie que l'utilisateur est connecté pour afficher le formulaire commentaire
        if(SessionHelpers::isLogin()){
            $estConnecte = true;
            $username = $_SESSION['USER']['username'];
            $email = $_SESSION['USER']['email'];
        } else {
            $estConnecte = false;
        }

        // Compétence associées à la vidéo
        $competences = $this->formationModel->competencesFormation($video["IDFORMATION"]);

        // Chargement des commentaires
        // Récupération de l'ID de la formation
        $idFormation = $this->formationModel->getFormationByVideoID($id);

        // Récupération des commentaires en fonction de la vidéo
        $commentaires = $this->formationModel->getCommentaireByFormationID($idFormation["IDFORMATION"]);

        // Ajout du commentaire dans la bdd

        if(isset($_POST["libelleCommentaireForm"])){
            $libelle = htmlspecialchars($_POST["libelleCommentaireForm"]);
            $id = $idFormation["IDFORMATION"];

            $this->formationModel->addCommentaire($libelle, $email, $id);
        }

        // On réucpère l'id de la certicication
        $idCerification = $this->formationModel->getCertificationByFormationID($video["IDFORMATION"]);

        // On verifie si l'utilisateur est certifié
        $idUtilisateur = $this->formationModel->getIDUserByEmail($email);
        $idUtilisateur = $idUtilisateur["IDINSCRIT"];


        $estCertifie = false;
        if ($this->formationModel->estCertifie($idCerification["IDCERTIFICATION"], $idUtilisateur)){
            $estCertifie = true;

            if (!isset($_POST["validation"]) && isset($_POST["verification"])){
                $this->formationModel->supprimerCertifie($idCerification["IDCERTIFICATION"], $idUtilisateur);
            }
        } elseif (!isset($_POST["validation"]) && isset($_POST["verification"])){
            $this->formationModel->ajouterCertifie($idCerification["IDCERTIFICATION"], $idUtilisateur);
        }


        $this->header();
        include("./views/formation/tv.php");
        $this->footer();
    }
}