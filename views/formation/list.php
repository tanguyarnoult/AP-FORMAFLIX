<div class="container">
    <div class="row pt-5">
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