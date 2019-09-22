<div class="row card">
    <div class="card-content">
        <div class="input-field col s6">
            <i class="material-icons prefix">movie</i>
            <input type="text" id="nom" name="nom" required>
            <label for="nom">Nom du film</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">panorama</i>
            <select id="genre">
                <option value="" disabled selected>Genre</option>
                <?php
                $ctr = 1;
                foreach($genres as $value) {
                    echo '<option value="' . $ctr . '">'
                        . $value['genre']
                        . '</option>';
                        $ctr++;
                }
                ?>
            </select>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">access_time</i>
            <input type="number" id="duree" name="duree"/>
            <label for="duree">Durée en minutes</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">short_text</i>
            <textarea class="materialize-textarea" id="resume"></textarea>
            <label for="resume">Résumé du film</label>
        </div>
    </div>
    <div class="card-action col s6">
            <button class="btn waves-effect addFilmBtn">Ajouteur le film</button>
        <div>
</div>
<script src="/PiePHP/webroot/js/ajaxUpdate.js"></script>