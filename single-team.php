<?php
get_header();
add_action( 'wp_enqueue_styles', wp_enqueue_style( 'single-team', get_stylesheet_directory_uri() . '/assets/css/single-team.css', array(), NULL, NULL));
add_action( 'wp_enqueue_scripts', wp_enqueue_script( 'single-team', get_stylesheet_directory_uri()."/assets/js/single-team.js", array( 'jquery' ), '1.0', true ));

$current_user_id = get_current_user_id();
$meta = get_team_meta(get_the_ID());
global $games_supported;
?>

<?php 
if ($current_user_id == $meta['author']) { ?>
    <a href="http://woncup.net/modifier-une-equipe?id=<?= get_the_ID() ?>" target='blank'>Modifier l'équipe</a>
<?php } ?>

<div id='team_container' post-id="<?= get_the_ID() ?>">
    <div id="team_header">
        <div id='team_banner'></div>
        <div id='team_logo'></div>
        <h1 id='team_name'><?= $meta['title'] ?></h1>
    </div>
    <div class="profile-containers-2" id='team_players'>
        <label for="">Joueurs</label>
        <div id="team_players_container">
        <?php foreach($meta['joueurs'] as $uniqueplayer) {
            $author = get_post($uniqueplayer);
            $author = $author->post_author;
            $player = get_player_meta($author);
            // print_r($player)?>
            <div class="team_unique_player">
                <div class="player_icon" id="<?=$uniqueplayer?>"></div>
                <a href="<?= get_players_permalink($author) ?>" target="_blank"><p id="player_name"><?=$player['pseudo']?></p></a>
            </div>
        <?php } ?>
        </div>
    </div>
    <div class="profile-containers-4 palmares">
        <label for="">Palmares</label>
        <div id="team-palmares">
            <div>
                <label for="">Nom</label>
                <p id="palmares-name"></p>
            </div>
            <div>
                <label for="">Place</label>
                <p id="palmares-place"></p>
            </div>
            <div>
                <label for="">Jeu</label>
                <p id="palmares-game"></p>
            </div>
            <div>
                <label for="">Description</label>
                <p id="palmares-description"></p>
            </div>
        </div>
        <div class="buttons-palmares">
            <button id="previous-palmares"><i class="fas fa-angle-left"></i></button>
            <p id="palmCount"></p>
            <button id="next-palmares"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>
    <div class="profile-containers-4" id='team_games'>
        <label for="">Jeux</label>
        <div>
        <?php foreach ($meta['games'] as $game) { ?>
            <?php foreach ($games_supported as $uniquegame) { ?>
                <?php if($game == $uniquegame['shortName']) {?>
                    <div>
                    <img src="<?=$uniquegame['icon']?>" alt="">
                    <p><?= $uniquegame['fullName']?></p>
                    </div>
        <?php } } }?>
        </div>
    </div>
    <div class="profile-containers-2">
            <label for="">A propos de l'équipe</label>
            <p><?=$meta['description']?></p>
    </div>
</div>

<?php
get_footer();
?>