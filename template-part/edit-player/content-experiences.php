<?php
global $games_supported;
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>

        <div class="experiences_container">
            <?php 
            if (!empty($meta['experiences'])) {
                $index = 0;
                foreach ($meta['experiences'] as $key) {
                ?>
                    <div id="past_experience_<?=$index?>" class="past_experience">
                            <div class="div-50">
                                <label for="team">Nom de l'équipe</label>
                                <input type="text" class="team" name="team_<?= $index ?>" value="<?= $key['team-name'];?>"/>
                            </div>
                            <div class="div-50">
                                <label for="role">Rôle dans l'équipe</label>
                                <input type="text" class="role" name="role_<?= $index ?>" value="<?= $key['team-role'];?>"/>
                            </div>

                            <div class="div-100">
                                <label for="game">Jeu</label>
                                <select name="game_<?= $index ?>" id="">
                                    <?php 
                                        foreach ($games_supported as $game) {?>
                                            <option value="<?=$game['shortName']?>" <?php if($key['team-game'] == $game['shortName']) echo "selected=\"selected\"";?>><?=$game['fullName']?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <div class="div-100">
                                <label for="description">Description du rôle</label>
                                <textarea class="description" name="description_<?= $index ?>"><?= $key['team-description']; ?></textarea>
                            </div>

                            <div class="div-100">
                                <label for="palmares">Palmarés avec l'équipe</label>
                                <textarea class="palmares" name="palmares_<?= $index ?>"><?= $key['team-palmares']; ?></textarea>
                            </div>
                            <p id="delete_<?=$index?>" class="delete_button" onclick="deleteExperience('<?php echo $index ?>')">supprimer</p>
                    </div>	
                <?php
                $index++;
                } 
            } else {
            ?>
            <div><p>Vous n'avez encore rentré aucune expérience</p></div>
            <?php 
        }?>
</div>