<div class="d-flex flex-column align-items-center fit-content m-auto">
    <div class="fit-content">
        <div class="frame">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video['IDENTIFIANTVIDEO']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="stand">
            <?= $video['LIBELLE'] ?>
        </div>
    </div>

        <div class="card card-dark mt-5 p-3">
            <div class="text-light"><?= $video['DESCRIPTION'] ?></div>

            <?php
            if (sizeof($competences) > 0) {
                ?>
                <hr class="dropdown-divider">
                <div>
                    <?php
                    foreach ($competences as $competence) {
                        ?>
                        <span class="badge bg-primary"><?= $competence["LIBELLECOMPETENCE"] ?></span>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>

        </div>

</div>

<!-- Affichage du bouton: formation completée -->


<?php

// Verifie que l'utilisateur est connecté
if ($estConnecte){
    ?>
    <!-- Affichage du formulaire de validation de formation -->

    <div class="validationFormation">
        <?php echo '<form method="POST" class="formCompleterFormation" action="./tv?id='.$video['IDENTIFIANTVIDEO'].'">'; ?>
        <div class="textValidationFormation">
        <label for="validation">J'ai suivi cette formation</label>


        <?php

        if($estCertifie == true || (isset($_POST["validation"]) && $_POST["validation"] == "valide")){
            echo'<input type="checkbox" id="validation" checked name="validation" value="valide" onclick="./tv?id='.$video['IDENTIFIANTVIDEO'].'">';
        } else {
            echo '<input type="checkbox" id="validation" name="validation" value="valide" onclick="./tv?id='.$video['IDENTIFIANTVIDEO'].'">';
        }
        ?>

        <br>
        <label for="verification">Vous êtes sur ?</label>
        <input type="checkbox" id="verification" name="verification">
        </div>

        <br>
        <input class="boutonValidationFormation" type="submit" value="Valider">
        </form>
    </div>

<center>
    <!-- Affichage du formulaire d'entrée d'un commentaire -->

            <?php echo '<form method="POST" class="commentaireForm" action="./tv?id='.$video['IDENTIFIANTVIDEO'].'">'; ?>
            <h1 class="h3 mb-3 fw-normal text-light commentaireTitle">Ajouter un commentaire</h1>
                <div class="form-floating mt">
                    <input name="libelleCommentaireForm" class="libelleCommentaireForm" id="floatingPassword" placeholder="Votre commentaire" required>
                </div>
                <button class="boutonCommentaire" type="submit">Envoyez votre commentaire</button>
            </form>



<?php
}
?>
        <!-- Affichage des commentaires -->



            <table class="commentaire">
                <?php
                    foreach ($commentaires as $commentaire){
                        echo '<tr class="ligneCommentaire">
                                <td class="colonnePseudoCommentaire"><p class="pseudoCommentaire">'.$commentaire["PRENOMINSCRIT"]." ".$commentaire["NOMINSCRIT"].'</p> 
                                <p class="dateCommentaire">'.$commentaire["DATE"].'</p>
                                </td>
                                <td class="colonneCommentaire"><p class="libelleCommentaire">'.$commentaire["LIBELLE"].'</p></td>
                              </tr>';
                    }
                ?>
            </table>
    </center>
</div>




