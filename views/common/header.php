<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormaFlix</title>
    <link rel="icon" type="image/png" href="./public/images/favicon.png" />

    <link href="./public/style/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./public/style/main.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="<?= isset($_GET['id']) ? 'brick' : '' ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <?php
        if (isset($_GET['id'])) {
            echo '<a class="navbar-brand" href="javascript: history.go(-1)">← Retour</a>';
        } else {
            echo '<a class="navbar-brand" href="./"><img class="brand" src="./public/images/logo.png"></a>';
        }
        ?>

        <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex flex-grow justify-content-end flex-grow p-2">
            <a href="./about" class="btn btn-outline-light">À propos</a>
        </ul>

        <?php
        if (\utils\SessionHelpers::isLogin()) {
            echo '<a href="./me" class="d-lg-inline-block ml-3 btn btn-danger">Mon compte</a>';
        } else {
            echo '<a href="./login" class="d-lg-inline-block ml-3 btn btn-outline-danger">Connexion</a>';
        }
        ?>
    </div>
</nav>