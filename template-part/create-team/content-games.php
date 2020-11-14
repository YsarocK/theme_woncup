<h3>Choisissez les jeux de l'équipe</h3>
<?php global $games_supported ?>
<label>Séletionnez les jeux de l'équipe</label>
<fieldset>
    <?php foreach ($games_supported as $game) {?>
        <div>
            <input type="checkbox" name="games[]" value="<?= $game['shortName']?>">
            <label for="coding"><?= $game['fullName']?></label>
        </div>
        
    <?php } ?>
</fieldset>