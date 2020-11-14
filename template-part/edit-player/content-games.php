<?php
global $games_supported;
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>

<div class="div-100">
    <div class="div-50">
        <label for="name_leagueoflegends">Pseudo League Of Legends</label>
        <input name="name_leagueoflegends" type="text" id="id_lol" value="<?= $meta['leagueoflegends']['pseudo'] ?>" />
    </div>
    <div class="div-100">
        <?php
        $roles = array(
            'Top',
            'Jungler',
            'Middle',
            'ADC',
            'Support',
        );

        foreach($meta['leagueoflegends']['roles'] as $playerole){
            if ($playerole == $role) {
                ?> checked <?php
            }
        }
        ?>
        <div class="div-100">
            <label for="rôle">Role(s)</label>
            <fieldset id='role-lol'>
                <?php foreach ($roles as $role) { ?>
                    <div>
                        <label for=""><?=$role?></label>
                        <input type="checkbox" value="<?=$role?>" name="<?=$role?>" <?php foreach($meta['leagueoflegends']['roles'] as $playerole){
                        if ($playerole == $role) {
                            ?> checked <?php
                            }
                        }?>>
                    </div>
                <?php } ?>
            </fieldset>
        </div>
    </div>
</div>

<div class="div-100">
    <div class="div-50">
        <label for="ID_inGame">Pseudo Fortnite</label>
        <input name="ID_inGame" type="text" id="id_lol" value="<?= $meta['pseudoFortnite'] ?>" />
    </div>
</div>