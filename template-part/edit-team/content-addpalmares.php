<?php
global $games_supported;
?>
<section class="add_container">
    <div class="div-50">
        <label for="event">Nom de l'événement</label>
        <input type="text" class="event" name="event"/>
    </div>
    <div class="div-50">
        <label for="place">Place finale</label>
        <input type="text" class="place" name="place"/>
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
        <label for="description">Description</label>
        <textarea class="description" name="description"></textarea>
    </div>

</section>