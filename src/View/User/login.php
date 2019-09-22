<?php
if(!empty($error)) {
    echo '<div class="row center-align">';
    echo '<h6 class="btn red">Les informations sont incorrectes<h6>';
    echo '</div>';
}
?>
<form method="post">
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