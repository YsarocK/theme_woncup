<?php
if (!$teamid) {
    $teamid = $_POST['post-id'];
} else {
    $teamid = $_GET['id'];
}
$meta  = get_team_meta($teamid);
?>
<div class="div-50">
    <label for="">Photo de profil</label>
    <div class="upload-button"><i class="fas fa-file-import"></i>Mettre à jour l'image de profil</div>
    <input class="upload-input" type="file" name="picture" id="picture" accept="image/gif, image/jpeg, image/png">
    <p class="uploaded-file"></p>
</div>
<div class="div-50">
    <label for="">Bannière</label>
    <div class="upload-button"><i class="fas fa-file-import"></i>Mettre à jour la bannière</div>
    <input class="upload-input" type="file" name="baneer" id="baneer" accept="image/gif, image/jpeg, image/png">
    <p class="uploaded-file"></p>
</div>
<div class="div-100">
    <label for="">Nom de l'équipe</label>
    <input type="text" value="<?= $meta['title'] ?>" name="nom">
</div>
<div class="div-100">
    <label for="">Description</label>
    <textarea name="descritpion" id="" cols="30" rows="10"><?= $meta['description'] ?></textarea>
</div>