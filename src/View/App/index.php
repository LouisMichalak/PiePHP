<?php
foreach($films as $index => $value) {
    echo'<div class="row card">'
        . '<div class="card-content">'
        . '<div class="col s6">'
        . '<strong>Nom : </strong>' . $value['nom']
        . '</div>'
        . '<div class="col s12">'
        . '<strong>Genre : </strong>' . $value['genre']['genre']
        . '</div>'
        . '<div class="col s9">'
        . '<strong>Resumé : </strong>' . $value['resume']
        . '</div>'
        . '<div class="col s3">'
        . '<strong>Durée : </strong>' . $value['duree'] . ' minutes'
        . '</div>'
        . '</div>'
        . '<div class="col s12 card-action">'
        . '<a href="/PiePHP/film/'.$value['id'].'">En savoir plus</a>'
        . '</div>'
        . '</div>';
}
?>