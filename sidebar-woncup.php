<?php
$current_user_id = get_current_user_id();
$user_profile = get_players_permalink($current_user_id);
$meta = get_player_meta($current_user_id);
?>
<div id='sidebar-woncup'>
    <?php if (is_user_logged_in()) { ?>
        <div id="playerteams">
            <div id="myTeams">
                <p>Mes équipes</p>
            </div>
            <?php foreach($meta['teams_ids'] as $team) {
                if('publish' === get_post_status( $team )) {
                    $args = array(
                        'ID' => $team,
                    );
                    $this_post = get_posts($args);
                    $teamMeta = get_team_meta($team);?>
                    <div class="team_sidebar" id="<?= $team ?>">
                        <a href="<?= get_permalink($team) ?>" target='blank'>
                            <div class="icon-picture"><img src="<?= wc_load_teams_pictures($team) ?>" alt=""></div>
                        </a>
                        <div class="team_sidebar_name">
                            <p><?= $teamMeta['title'] ?></p>
                        </div>
                    </div>
                <?php 
                }
            }
            ?>
            <div id="add_team">
                <a href="http://woncup.net/creer-une-equipe/" target='blank'>
                    <div id="add_team_icon">
                        <i class="fas fa-plus"></i>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <div id="playermenu">
        <div id="identity_container"> 
            <img src="<?=get_stylesheet_directory_uri().'/img/logo_woncup_blue.png'?>" alt="">
            <p id="siteName">Woncup<span> Social</span></p>
        </div>
        <?php if(is_user_logged_in()) { ?>
        <ul>
            <li><a href="http://woncup.net/" id="home-menu">
            <span data-jam="home" data-fill="#fff" data-width="15" data-height="15"></span>
             Accueil
            </a></li>

            <li><a href="<?= get_players_permalink($current_user_id) ?>">
            <span data-jam="user" data-fill="#fff" data-width="15" data-height="15"></span>
             Profil
            </a></li>

            <li><a href="http://woncup.net/modifier-mon-profil/">
            <span data-jam="pencil" data-fill="#fff" data-width="15" data-height="15"></span>
            Modifier le profil 
            </a>
            <i class="fas fa-angle-down" id="menu_dropdown"></i>
            </li>

            <ul class=ul-child>
                <li><a class="edit_player_shortcut" shortcut='about' href="http://woncup.net/modifier-mon-profil/?section=about">A propos de moi</a></li>
                <li><a class="edit_player_shortcut" shortcut='games' href="http://woncup.net/modifier-mon-profil/?section=games">Mes jeux</a></li>
                <li><a class="edit_player_shortcut" shortcut='social' href="http://woncup.net/modifier-mon-profil/?section=social">Réseaux sociaux</a></li>
                <li><a class="edit_player_shortcut" shortcut='experiences' href="http://woncup.net/modifier-mon-profil/?section=experiences">Expériences</a></li>
                <li><a class="edit_player_shortcut" shortcut='addexperiences' href="http://woncup.net/modifier-mon-profil/?section=addexperiences">Ajouter une expérience</a></li>
            </ul>
            <li id="logout"><a href="http://woncup.net/logout"><span data-jam="log-out" data-fill="#fff" data-width="15" data-height="15"></span> Se déconnecter</a></li>
        </ul>
        <?php } else { ?>
        <ul>
            <li><a href="http://woncup.net/login"><span data-jam="log-in" data-fill="#fff" data-width="15" data-height="15"></span> Se connecter</a></li>
            <li><a href="http://woncup.net/register"><span data-jam="log-in" data-fill="#fff" data-width="15" data-height="15"></span> S'inscrire</a></li>
        </ul>
        <?php } ?>
    </div>
</div>