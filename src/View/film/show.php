<div class="row card">
    <div class="card-content">
        <div class="col s6">
            <strong>Nom : </strong><?= $film['nom']?>
        </div>
        <div class="col s12">
            <strong>Genre : </strong><?= $film['genre']['genre']?>
        </div>
        <div class="col s9">
            <strong>Resumé : </strong><?= $film['resume']?>
        </div>
        <div class="col s3">
            <strong>Durée : </strong> minutes <?= $film['duree']?>
        </div>
    </div>
    <div class="col s12 card-action">
        <a href="/PiePHP/film/'.$value['id'].'">En savoir plus</a>
    </div>
</div>