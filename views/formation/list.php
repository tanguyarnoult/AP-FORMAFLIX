<div class="container">
    <div class="row pt-5">

        <!-- Formulaire du choix d'une compétences -->

        <form method="get" action="formations">
            <select name="competence">
                <option value="0">Choisissez une compétence</option>

                <?php

                // Création des options pour le select avec une boucle FOR (plutot que foreach) car on utilise le $i comme value

                for($i=1; $i<sizeof($competences); $i++){
                    if(isset($_GET["competence"]) && $_GET["competence"] == $i){
                        // On ajoute selected au option si la compétence à été choisie par l'utilisateur
                        echo '<option value="'.$i.'" selected> '.$competences[$i].'</option>';
                    } else {
                        echo '<option value="'.$i.'"> '.$competences[$i].'</option>';
                    }
                }

                ?>


            </select>
            <button type="submit">Choisir</button>
        </form>

        <?php

        foreach ($formations as $formation) {
            ?>


            <div class="col-sm-12 p-3">
                <div class="card card-hover">
                    <div class="card-body d-flex">
                        <div class="p-3">
                            <img class="preview-image" src="<?= $formation["IMAGE"] ?>">
                        </div>
                        <div class="p-3 flex-grow-1">
                            <h5 class="mb-0 pb-0"><?= $formation['LIBELLE']; ?></h5>
                            <p><?= $formation['DESCRIPTION'] ?></p>
                            <a href="./tv?id=<?= $formation['IDENTIFIANTVIDEO'] ?>" class="btn btn-outline-primary">Voir la formation →</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
</div>