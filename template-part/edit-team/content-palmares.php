<?php
global $games_supported;

if (!$teamid) {
    $teamid = $_POST['post-id'];
} else {
    $teamid = $_GET['id'];
}
$meta = get_team_meta($teamid);
?>

        <div class="palmares_container">
            <?php 
            if (!empty($meta['palmares'])) {
                $index = 0;
                foreach ($meta['palmares'] as $key) {
                ?>
                    <div id="past_palmares_<?=$index?>" class="past_palmares">
                            <div class="div-50">
                                <label for="team">Nom de l'évelement</label>
                                <input type="text" class="team" name="team_<?= $index ?>" value="<?= $key['palmares-name'];?>"/>
                            </div>

                            <div class="div-50">
                                <label for="team">Place finale</label>
                                <input type="text" class="team" name="team_<?= $index ?>" value="<?= $key['palmares-place'];?>"/>
                            </div>

                            <div class="div-100">
                                <label for="game">Jeu</label>
                                <select name="game_<?= $index ?>" id="">
                                    <?php 
                                        foreach ($games_supported as $game) {?>
                                            <option value="<?=$game['shortName']?>" <?php if($key['palmares-game'] == $game['shortName']) echo "selected=\"selected\"";?>><?=$game['fullName']?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <div class="div-100">
                                <label for="description">Description</label>
                                <textarea class="description" name="description_<?= $index ?>"><?= $key['palmares-description']; ?></textarea>
                            </div>

                            <p id="delete_<?=$index?>" class="delete_button" onclick="deletePalmares('<?php echo $index ?>')">supprimer</p>
                    </div>	
                <?php
                $index++;
                } 
            } else {
            ?>
            <div><p>Vous n'avez encore rentré aucun palmares</p></div>
            <?php 
        }?>
</div>