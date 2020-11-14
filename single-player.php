<?php
get_header();
$current_user_id = get_current_user_id();
$current_player = get_post();
$current_player = $current_player->post_author;
$player_meta = get_player_meta($current_player);

add_action( 'wp_enqueue_styles', wp_enqueue_style( 'player', get_stylesheet_directory_uri() . '/assets/css/single-player.css', array(), NULL, NULL));
add_action( 'wp_enqueue_styles', wp_enqueue_style( 'stats', get_stylesheet_directory_uri() . '/assets/css/lolstats.css', array(), NULL, NULL));
add_action( 'wp_enqueue_scripts', wp_enqueue_script( 'single-player', get_stylesheet_directory_uri()."/assets/js/single-player.js", array( 'jquery' ), '1.0', true ));

?>

<a href="http://woncup.net/modifier-mon-profil/">Editer le profil</a>
<div class="player-profile" id="player-profile" post-id="<?=get_the_ID()?>">
    <?php if($current_user_id == $current_player) {?>
    <?php } ?>
    <div class="profile-containers-4 player-main-infos">
        <div class="player-picture main-picture" style="overflow: hidden"><img style="width: 100%; height: auto;" src="<?php wc_player_picture(get_the_id()); ?>" alt=""></div>
        <div class="player-infos">
            <div>
                <h1><?=$player_meta['pseudo']?></h1>
                <p><?=$player_meta['prenom']?> <?=$player_meta['nom']?></p>
            </div>
            <div class="social_links">
                <ul>
                <?php $social_media = $player_meta['social_links'];
                    if(!empty($social_media['twitter']['url'])) { ?>
                        <li><a href="https://twitter.com/<?= $social_media['twitter']['url'] ?>"><i class="fab fa-twitter"></i></a></li>
                <?php } if(!empty($social_media['linkedin']['url'])) { ?>
                        <li><a href="https://linkedin.com/in/<?= $social_media['linkedin']['url'] ?>"><i class="fab fa-linkedin-in"></i></a></li>
                <?php } if(!empty($social_media['instagram']['url'])) { ?>
                        <li><a href="https://instagram.com/<?= $social_media['instagram']['url'] ?>"><i class="fab fa-instagram"></i></a></li>
                <?php } if(!empty($social_media['discord']['url'])) { ?>
                        <li><i value="<?= $social_media['discord']['url'] ?>" id="pseudo_discord" class="fab fa-discord"></i></li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="profile-containers-2">
        <label for="">Description</label>
        <p><?=$player_meta['description']?></p>
    </div>
    <div class="profile-containers-4 experiences">
        <label for="">Expériences</label>
        <div id="player-experiences">
            <div>
                <label for="">Team</label>
                <p id="team-name" style="font-weight: bolder"></p>
            </div>
            <div>
                <label for="">Jeu</label>
                <p id="team-game"></p>
            </div>
            <div>
                <label for="">Rôle</label>
                <p id="team-role"></p>
            </div>
            <div>
                <label for="">Description</label>
                <p id="team-description"></p>
            </div>
            <div>    
                <label for="">Palmares</label>
                <p id="team-palmares" style="font-style: italic;"></p>
            </div>
        </div>
        <div class="buttons-experiences">
            <button id="previous-experience"><i class="fas fa-angle-left"></i></button>
            <p id="expCount"></p>
            <button id="next-experience"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>
    <div class="profile-containers-2" id="player_stats_container">
        <div id="stats_menu">
            <label>STATISTIQUES</label>
            <ul>
                <?php if($player_meta['leagueoflegends']['pseudo'] != '') { ?>
                    <li id="leagueoflegends" class="game_switcher"><img src="http://woncup.net/wp-content/themes/theme_woncup/img/games/leagueoflegends_logo.png" alt=""></li>
                <?php };
                if($player_meta['pseudoTft'] != '') {?>
                    <li id="tft" class="game_switcher"><img src="http://woncup.net/wp-content/themes/theme_woncup/img/games/tft_logo.png" alt=""></li>
                <?php };
                if($player_meta['pseudoValorant'] != '') {?>
                    <li id="valorant" class="game_switcher"><img src="http://woncup.net/wp-content/themes/theme_woncup/img/games/valorant_logo.png" alt=""></li>
                <?php };
                if($player_meta['pseudoFortnite'] != '') {?>
                <li id="fortnite" class="game_switcher"><img src="http://woncup.net/wp-content/themes/theme_woncup/img/games/fortnite_logo.png" alt=""></li>
                <?php } ?>
            </ul>
        </div>
        
        <div id="player-stats">
            
        </div>
    </div>
</div>

<?php
get_footer();
?>