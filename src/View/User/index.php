<h3>Mes Informations</h3>
<div class="row card">
    <div class="card-content">
        <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input type="email" id="email" name="email" required>
            <label for="email"><?= $email ?></label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">person</i>
            <input type="text" id="nom" name="nom" required>
            <label for="nom"><?= $nom ?></label>
        </div>
        <div class="input-field col s6">
            <input type="text" id="prenom" name="prenom" required>
            <label for="prenom"><?= $prenom ?></label>
        </div>
    </div>
    <div class="col s12 card-action">
            <button class="btn waves-effect validationUpdate">Valider les modifications</button>
    </div>
</div>
<div class="center-align pull-12">
<a class="waves-effect waves-light red btn modal-trigger" href="#modal1">Modifier mon mot de passe</a>
</div>

<div id="modal1" class="modal bottom-sheet">
<div class="modal-content row">
    <div class="input-field col s6">
        <i class="material-icons prefix">security</i>
        <input type="password" id="oldPwd" name="oldPwd" required>
        <label for="oldPwd">Ancien mot de passe</label>
    </div>
    <div class="input-field col s6">
        <input type="password" id="pwd" name="pwd" required>
        <label for="pwd">Nouveau mot de passe</label>
    </div>
</div>
<div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat passwordUpdate">Confirmer</a>
</div>
</div>

<script type="text/javascript" src="/PiePHP/webroot/js/ajaxUpdate.js"></script>