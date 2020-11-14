<h3>Choisir des joueurs</h3>

<div class="team_players" id="team_players">
    <?php
    for ($i=0; $i<5; $i++) {
        $args = array(
            'post_type' => 'sp_player',
            'posts_per_page' => -1,
            'post__not_in' => array($current_player_id),
        );
        
        $query = new WP_Query($args);
        if ($query->have_posts() ) : 
        ?>
        <label class="playersSelectLabel" for="players">Joueur <?=$i+1?></label>
        <select class="playersSelect" name="joueur_<?=$i+1?>">
        
        <?php
        echo '<option value="default">Selectionner un joueur</option>';
        while ( $query->have_posts() ) : $query->the_post();
                $author = get_post(get_the_ID());
                $author = $author->post_author;
                $player = get_player_meta($author);
                echo '<option value="' . get_the_ID() . '">' . $player['pseudo'] . '</option>';
        endwhile;
        echo '</select>';
        wp_reset_postdata();
        endif;
    }
    ?>
</div>
<p id="addPlayer">Ajouter un joueur</p>