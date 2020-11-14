<?php
global $games_supported;
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>
<h3 id="main_title" post-id="<?=get_the_ID()?>">A propos de l'équipe</h3>

<div class="div-50">
    <label for="first_name">Nom de l'équipe</label>
        <input name="first_name" type="text" id="first_name"/>
</div>

<div class="div-100">
    <label for="description">Description de l'équipe</label>
    <textarea name="description" cols="30" rows="10" id="description"></textarea>
</div>


