<?php

use utils\Gravatar;
use utils\SessionHelpers;

$account = SessionHelpers::getConnected();
?>
<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <img class="m-5" src="<?= Gravatar::get_gravatar($account['email']) ?>"/>
                <h3 class="text-center pb-5">Bienvenue « <?= $account['username'] ?> »</h3>
                <p>Vous avez ces certifications:</p>
                <div class="ulCertificationUser">
                <ul>
                <?php

                foreach ($certifications as $certification){
                    echo "<li class='liCertificationUser'>".$certification["LIBELLE"];
                    switch ($certification["DIFFICULTE"]){
                        case 1:
                            echo '&#160&#160 <img src="./public/images/medailles/1.png" width="3%">';
                            break;
                        case 2:
                            echo '&#160&#160 <img src="./public/images/medailles/2.png" width="3%">';
                            break;
                        case 3:
                            echo '&#160&#160 <img src="./public/images/medailles/3.png" width="3%">';
                            break;
                        default:
                            echo " (".$certification["DIFFICULTE"].")";

                    }
                    echo "</li>";
                }

                ?>
                </ul>
                </div>
                <div class="mt-5">
                    <a class="btn btn-danger d-block full" href="logout">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>
</div>


