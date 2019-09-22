<?php
if(!empty($error)) {
    echo '<div class="row center-align">';
    echo '<h6 class="btn red">Les informations ne sont pas au format '
        . 'exigé ou l\'adresse mail est deja utilisée<h6>';
    echo '</div>';
}
?>
<form method="post" class="row">
    <div class="input-field col s6">
        <i class="material-icons prefix">person</i>
        <input type="text" id="nom" name="nom" required>
        <label for="nom">Nom</label>
    </div>
    <div class="input-field col s6">
        <input type="text" id="prenom" name="prenom" required>
        <label for="prenom">Prénom</label>
    </div>
    <div class="input-field col s12">
        <i class="material-icons prefix">email</i>
        <input type="email" id="email" name="email" required>
        <label for="email">Email</label>
    </div>
    <div class="input-field col s12">
        <i class="material-icons prefix">security</i>
        <input type="password" id="pwd" name="pwd" required>
        <label for="pwd">Password</label>
    </div>
    <input class="btn" type="submit" value="envoyer">
</form>