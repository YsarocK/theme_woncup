<?php
global $games_supported;
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>

<div id="player-picture-manage" class="div-100">
    <!-- IMAGE DE PROFIL -->
    <div id="img_container">
        <div class="icon-picture edit-profile-picture" style="overflow: hidden"><img style="width: 100%; height: auto;" src="wc_current_user_picture()" alt=""></div>
    </div>

    <div class='picture-changer'>
        <label for="">Photo de profil</label>
        <div class="upload-button"><i class="fas fa-file-import"></i>Mettre à jour l'image de profil</div>
        <input class="upload-input" type="file" name="picture" id="myfile" accept="image/gif, image/jpeg, image/png">
        <p class="uploaded-file"></p>
    </div>
</div>

<div class="div-50">
    <label for="first_name">Prénom</label>
    <input name="first_name" type="text" id="first_name" value="<?= $meta['prenom'] ?>" />
</div>
<div class="div-50">
    <label for="last_name">Nom</label>
    <input name="last_name" type="text" id="last_name" value="<?= $meta['nom'] ?>" />
</div>
<div class="div-50">
    <label for="date_de_naissance">Date de naissance</label>
    <input name="date_de_naissance" type="date" id="date_de_naissance" value="<?= date($meta['birthdate']) ?>" />
</div>
<div class="div-50">
    <label for="pseudo">Pseudo</label>
    <input name="pseudo" type="text" id="pseudo" value="<?= $meta['pseudo'] ?>" />
</div>        
<div class="div-100">
    <label for="description">Description</label>
    <textarea name="description" cols="30" rows="10" id="description"><?= $meta['description'] ?></textarea>
</div>