<div class="cover-gradient full-height pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card card-dark">
                    <div class="card-body text-center p-5">
                        <main class="form-signin">

                            <form method="POST" action="./register">
                                <h1 class="h3 mb-3 fw-normal text-light">Inscription</h1>

                                <div class="form-floating mt">
                                    <input name="nom" type="text" class="form-control" id="floatingPassword" placeholder="Nom" required>
                                    <label for="floatingPassword">Nom</label>
                                </div>

                                <div class="form-floating mt-2">
                                    <input name="prenom" type="text" class="form-control" id="floatingPassword" placeholder="Prénom" required>
                                    <label for="floatingPassword">Prénom</label>
                                </div>

                                <br>

                                <div class="form-floating mt-2">
                                    <input name="login" type="email" class="form-control" id="floatingInput" placeholder="Email" required>
                                    <label for="floatingInput">Adresse email</label>
                                </div>

                                <br>

                                <div class="form-floating mt-2">
                                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" required>
                                    <label for="floatingPassword">Mot de passe</label>
                                </div>

                                <div class="form-floating mt-2">
                                    <input name="password2" type="password" class="form-control" id="floatingPassword" placeholder="Retapez votre mot de passe" required>
                                    <label for="floatingPassword">Retapez votre mot de passe</label>
                                </div>

                                <p class="labelDiplome">Quel est votre dernier diplome obtenu ?</p>
                                    <select class="selectDiplome" name="diplome">
                                        <?php
                                            foreach ($diplomes as $diplome){
                                                echo '<option value="'.$diplome["IDDIPLOME"].'">'.$diplome["LIBELLE"].'</option>';
                                            }
                                        ?>
                                    </select>


                                <button class="w-100 mt-5 btn btn-lg btn-primary" type="submit">S'inscrire</button>
                            </form>

                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>