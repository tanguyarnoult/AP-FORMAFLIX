<?php


namespace controllers;


use controllers\base\Web;
use models\AccountModel;
use utils\SessionHelpers;

class Account extends Web
{
    protected $accountModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }

    // Méthode de connexion. Prise des paramètre en POST
    function login()
    {
        $error = false;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            if ($this->accountModel->login($_POST["login"], $_POST["password"])) {
                $this->redirect("me");
            } else {
                // Connexion impossible avec les identifiants fourni.
                $error = true;
            }
        }

        $this->header();
        include("views/account/login.php");
        $this->footer();
    }

    // Déconnexion et suppression de la SESSION.
    function logout()
    {
        SessionHelpers::logout();
        $this->redirect("login");
    }

    // Affiche l'utilisateur actuellement connecté.
    function me()
    {
        $certifications = $this->accountModel->getCertificationByUserEmail($_SESSION['USER']['email']);

        $this->header();
        include("views/account/me.php");
        $this->footer();
    }


    // Affiche le formulaire d'inscription

    function register(){
        // Verifie les données entrées par l'utilisateur

        if(isset($_POST["diplome"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["password2"]) && $_POST["password"] == $_POST["password2"]){
            $nom = htmlspecialchars($_POST["nom"]);
            $prenom = htmlspecialchars($_POST["prenom"]);
            $login = htmlspecialchars($_POST["login"]);
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT, ['cost' => 12]);
            $diplome = htmlspecialchars($_POST["diplome"]);

            $this->accountModel->register($nom, $prenom, $login, $password, $diplome);

            $this->login();
        }

        // On récupère l'ID Max des diplomes pour ensuite faire une boucle pour
        $maxIDDiplome = $this->accountModel->getMaxIDDiplome();
        $maxIDDiplome = $maxIDDiplome["MAX"];

        $diplomes = [];
        for($i=1; $i<=$maxIDDiplome; $i++) {
            $diplome = $this->accountModel->getByDiplomeID($i);

            if(isset($diplome)){
                array_push($diplomes, $diplome);
            }
        }

        $this->header();
        include("views/account/register.php");
        $this->footer();
    }
}