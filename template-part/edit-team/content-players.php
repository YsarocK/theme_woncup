<?php
$teamid = $_POST['post-id'];
$meta  = get_team_meta($teamid);
?>

<?php 
foreach($meta['joueurs'] as $playerid){
    $author = get_post($playerid);
    $author = $author->post_author;
    $player = get_player_meta($author);
    ?>

    <div class="div-100 unique_player" player-id='<?= $playerid ?>'>
        <div>
            <div class="player_icon" id="<?= $playerid ?>"></div>
            <p><?= $player['pseudo'] ?></p>
            <?php if($meta['author'] == $author) {?>
                <i class="fas fa-star"></i>
            <?php } ?>
        </div>
        <div>
            <i class="fas fa-times deletePlayer"></i>
        </div>
    </div>

<?php
}
?>

<div class="div-100">
    <?php 

        $args = array(
            'post_type' => 'sp_player',
            'posts_per_page' => -1,
            'post__not_in' => array($current_player_id),
        );

        $query = new WP_Query($args);
        if ($query->have_posts() ) : 
        ?>
        <label class="playersSelectLabel" for="players">Ajouter un joueur</label>
        <select class="playersSelect new_player" name="new_player">

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

    ?>
</div>