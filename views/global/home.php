<body>

<style>
    video{
        margin-top: -6%;
    }
</style>

<div id=video>
<video id="videoarrivee" width="100%" src="./public/intro.mp4" autoplay muted>
</div>


<div>
    <div class="cover cover-gradient">
        <h1>Votre plateforme de formation</h1>
        <h3>En 1-clic, partout, tout le temps…</h3>
    </div>
    <div class="bg-dark home-bottom">
        <h3>Prêt ? 3, 2, 1…</h3>
        <a href="./formations" class="btn btn-xlarge btn-danger mt-3">Découvrez nos formations →</a>
    </div>
</div>


<script>
    document.getElementById("videoarrivee").addEventListener("ended",function() {
        document.getElementById("video").style.display = "none"
    });
</script>
</body>