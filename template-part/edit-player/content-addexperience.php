<?php
global $games_supported;
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>
<section class="add_container">
    <div class="div-50">
        <label for="team">Nom de l'équipe</label>
        <input type="text" class="team" name="team"/>
    </div>
    <div class="div-50">
        <label for="role">Rôle dans l'équipe</label>
        <input type="text" class="role" name="role"/>
    </div>

    <div class="div-100">
        <label for="game">Jeu</label>
        <select name="game" id="">
            <?php 
                foreach ($games_supported as $game) {?>
                    <option value="<?=$game['shortName']?>"><?=$game['fullName']?></option>
            <?php }
            ?>
        </select>
    </div>

    <div class="div-100">
        <label for="description">Description du rôle</label>
        <textarea class="description" name="description"></textarea>
    </div>

    <div class="div-100">
        <label for="palmares">Palmarés avec l'équipe</label>
        <textarea class="palmares" name="palmares"></textarea>
    </div>
</section>