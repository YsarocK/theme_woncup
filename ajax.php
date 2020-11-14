<?php
add_action( 'wp_ajax_load_user_experiences', 'woncup_load_user_experiences' );
add_action( 'wp_ajax_nopriv_load_user_experiences', 'woncup_load_user_experiences' );

function woncup_load_user_experiences() {
    $id = $_POST['post_id'];
    $the_author = get_post($id);
    $the_author = $the_author->post_author;

    $meta = get_player_meta($the_author);
    $experiences = $meta['experiences'];
    $experiences = json_encode($experiences);

    echo $experiences;

    wp_die();
}

add_action( 'wp_ajax_load_team_palmares', 'woncup_load_team_palmares' );
add_action( 'wp_ajax_nopriv_load_team_palmares', 'woncup_load_team_palmares' );

function woncup_load_team_palmares() {
    $id = $_POST['post_id'];
    $post = get_post($id);

    $meta = get_team_meta($post);
    $palmares = $meta['palmares'];
    $palmares = json_encode($palmares);

    echo $palmares;

    wp_die();
}

add_action( 'wp_ajax_load_player_picture', 'woncup_load_player_picture' );
add_action( 'wp_ajax_nopriv_load_player_picture', 'woncup_load_player_picture' );

function woncup_load_player_picture() {
    $id = $_POST['post_id'];
    $the_author = get_post($id);
    $the_author = $the_author->post_author;

    $meta = get_player_meta($the_author);
    $picture = $meta['picture'];
    
    if(!empty($picture)){
        $directory = wp_upload_dir();
        $basedir = $directory['basedir'];
        $url = $directory['url'];
        
        $file = $basedir . '/' . $picture;
        if ( file_exists( $file ) ) {
            $file = $url . '/' . $picture;
            echo $file;
        } else {
            echo 'http://woncup.net/wp-content/themes/theme_woncup/img/basic-profile-pic.jpg'; 
        }
    } else {
        echo 'http://woncup.net/wp-content/themes/theme_woncup/img/basic-profile-pic.jpg';
    }

    wp_die();
}

add_action( 'wp_ajax_load_user_picture', 'woncup_load_user_picture' );
add_action( 'wp_ajax_nopriv_load_user_picture', 'woncup_load_user_picture' );

function woncup_load_user_picture() {

    $current_user_id = get_current_user_id();
    $meta = get_player_meta($current_user_id);
    $picture = $meta['picture'];

    if(!empty($picture)){
        $directory = wp_upload_dir();
        $basedir = $directory['basedir'];
        $url = $directory['url'];
        
        $file = $basedir . '/' . $picture;
        if ( file_exists( $file ) ) {
            $file = $url . '/' . $picture;
            echo $file;
        } else {
            echo 'http://woncup.net/wp-content/themes/theme_woncup/img/basic-profile-pic.jpg'; 
        }
    } else {
        echo 'http://woncup.net/wp-content/themes/theme_woncup/img/basic-profile-pic.jpg';
    }

    wp_die();

};

add_action( 'wp_ajax_load_teams_pictures', 'woncup_load_teams_pictures' );
add_action( 'wp_ajax_nopriv_load_teams_pictures', 'woncup_load_teams_pictures' );

function woncup_load_teams_pictures() {

    $post_id = $_POST['post-id'];
    $meta = get_team_meta($post_id);
    $picture = $meta[$_POST['type']];

    if(!empty($picture)){
        $directory = wp_upload_dir();
        $basedir = $directory['basedir'];
        $url = $directory['url'];
        
        $file = $basedir . '/' . $picture;
        if ( file_exists( $file ) ) {
            $file = $url . '/' . $picture;
            echo $file;
        } else {
            echo 'http://woncup.net/wp-content/themes/theme_woncup/img/basic-profile-pic.jpg'; 
        }
    } else {
        echo 'http://woncup.net/wp-content/themes/theme_woncup/img/basic-profile-pic.jpg';
    }

    wp_die();
}

add_action( 'wp_ajax_load_template_player', 'woncup_load_template_player' );
add_action( 'wp_ajax_nopriv_load_template_player', 'woncup_load_template_player' );

function woncup_load_template_player() {

    $current_user_id = get_current_user_id();
    $meta = get_player_meta($current_user_id);
    // SAUVEGARDE DES DONNEES
    $data = $_POST['data'];
    $actualTemplate = $_POST['actualTemplate'];
    $req = $_POST['req'];
    $img = $_FILES['file'];
    $roles = $_POST['roles'];

    if ($actualTemplate == 'about') {
    
        if ($data['0']['value']) {
            update_usermeta( $current_user_id, 'first_name', $data['0']['value'] );
        };
    
        if ($data['1']['value']) {
            update_usermeta( $current_user_id, 'last_name', $data['1']['value'] );
        };

        if ($data['2']['value']) {
            update_field('player_birthdate', $data['2']['value'], 'user_'.$current_user_id);
        };

        if ($data['3']['value']) {
            update_field('player_pseudo', $data['3']['value'], 'user_'.$current_user_id);
        };

        if ($data['4']['value']) {
            update_usermeta( $current_user_id, 'description', $data['4']['value'] );
        };
    } 
    elseif($actualTemplate == 'social') {
        $social_links = array(
            'discord' => array (
                'title' => '',
                'url' => $data['3']['value'],
                'target' => '',
            ),
            'twitter' => array (
                'title' => '',
                'url' => $data['0']['value'],
                'target' => '',
            ),
            'instagram' => array (
                'title' => '',
                'url' => $data['2']['value'],
                'target' => '',
            ),
            'linkedin' => array (
                'title' => '',
                'url' => $data['1']['value'],
                'target' => '',
            )
        );
        update_field('player_socials', $social_links, 'user_'.$current_user_id);

    } elseif($actualTemplate == 'experiences') {
        $experiences = array_chunk($data, 5);
        $experiencesNumber = count($experiences);
        if (!empty($experiences)) {
            foreach($experiences as $experience) {
                $maj_experience['team-name'] = $experience['0']['value'];
                $maj_experience['team-role'] = $experience['1']['value'];
                $maj_experience['team-game'] = $experience['2']['value'];
                $maj_experience['team-description'] = $experience['3']['value'];
                $maj_experience['team-palmares'] = $experience['4']['value'];
                if(!empty($maj_experience['team-name'])){
                    $newexperiences[] = $maj_experience;                            
                };
            };
        };
        $newexperiences = json_encode($newexperiences);
        update_field('experiences', $newexperiences, 'user_'.$current_user_id);

    } elseif($actualTemplate == 'addexperience') {
        $previousexperiences = $meta['experiences'];
        $data;
        if (!empty($data['0']['value'])) {
                $new_experience['team-name'] = $data['0']['value'];
                $new_experience['team-role'] = $data['1']['value'];
                $new_experience['team-game'] = $data['2']['value'];
                $new_experience['team-description'] = $data['3']['value'];
                $new_experience['team-palmares'] = $data['4']['value'];
                $previousexperiences[] = $new_experience;
            };         
        $previousexperiences = json_encode($previousexperiences); 
        update_field('experiences', $previousexperiences, 'user_'.$current_user_id);
    
    } elseif($actualTemplate == 'games'){        
        // LEAGUE OF LEGENDS
        if ($data) {
            $leagueoflegends['pseudo'] = $data['0']['value'];
            foreach ($roles as $role) {
                $newroles[] = $role['value'];
            };
            $leagueoflegends['roles'] = $newroles;
        };
        update_field('league_of_legends_data', $leagueoflegends, 'user_'.$current_user_id);
    };

    if($req != 'reload'){
        get_template_part('template-part/edit-player/content', $req);
    };

    wp_die();

};

add_action( 'wp_ajax_load_template_team_creation', 'woncup_load_template_team_creation' );
add_action( 'wp_ajax_nopriv_load_template_team_creation', 'woncup_load_template_team_creation' );

function woncup_load_template_team_creation() {

    $current_user_id = get_current_user_id();
    $template = array('about', 'players', 'games', 'teamcreated');
    $req = $_POST['req'];
    $infos = $_POST['infos'];
    $players = $_POST['players'];
    $games = $_POST['games'];

    if(!empty($players) && !empty($infos['0']['value']) && !empty($games)){
        $newteamargs = array(
            'post_title'    =>   $infos['0']['value'],
            'post_content'  =>   $infos['1']['value'],
            'post_type'     =>   'sp_team',
            'post_status'   =>   'publish',
            'post_author'   =>   $current_user_id,
        );

        // Création de l'équipe
        $newteam = wp_insert_post( $newteamargs, true );

        $args = array(
            'post_type' => 'sp_player',
            'numberposts' => 1,
            'author' => $current_user_id,
        );
        $this_post = get_posts($args);
        $this_post = $this_post['0'];
        $playersList["joueur_1"] = $this_post->ID;

        // AJOUT DES JEUX A L'EQUIPE
        foreach ($games as $game){
            $team_games[] = $game['value'];
        };
        update_field('post_game', $team_games, $newteam);

        // AJOUT DES JOUEURS DANS LA TEAM
        $i = 2;
        foreach ($players as $player) {
            $playerid = $player['value'];
            if(!in_array($playerid, $playersList) && ($playerid != 'default')){
                // Ajout du joueur à la liste
                $playersList["joueur_{$i}"] = $playerid;
                $i = $i+1;
            }
        }
        $playersListJSON = json_encode($playersList);
        update_field('post_players', $playersListJSON, $newteam);

        // AJOUT DE LA TEAM AUX JOUEURS
        foreach($playersList as $player){
            $author = get_post($player);
            $author = $author->post_author;
            $teams = get_player_meta($author);
            $teams = $teams['teams_ids'];
            $teams[] = $newteam;
            $teams = json_encode($teams);
            update_field('player_teams', $teams, 'user_'.$author);
        };
    };
    get_template_part('template-part/create-team/content', $template[$req]);

    wp_die();
}

add_action( 'wp_ajax_upload_file', 'upload_file' );
add_action( 'wp_ajax_nopriv_upload_file', 'upload_file' );

function upload_file() {

    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $uploadedfile = $_FILES['file'];
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    basename($movefile['file']);
    
    if ($movefile && !isset($movefile['error'])) {
        echo "File Upload Successfully";
        if ($_POST['post'] == 'user'){
            $post = get_current_user_id();
            update_field('player_picture', basename($movefile['file']),'user_'.$post);
        } else {
            $post = $_POST['post'];
            update_field('post_picture', basename($movefile['file']), $post);
        }
    } else {
        echo $movefile['error'];
    }

    wp_die();
}

add_action( 'wp_ajax_load_template_team', 'load_template_team' );
add_action( 'wp_ajax_nopriv_load_template_team', 'load_template_team' );

function load_template_team() {
    $current_user_id = get_current_user_id();
    $req = $_POST['req'];
    $post_id = $_POST['post-id'];
    $meta = get_team_meta($post_id);
    
    // SAUVEGARDE DES DONNEES
    $data = $_POST['data'];
    $actualTemplate = $_POST['actualTemplate'];
    $req = $_POST['req'];
    $img = $_FILES['file'];

    if ($actualTemplate == 'about') {
        $mypost = array(
            'ID' => $post_id,
            'post_title' => $data['0']['value'],
            'post_content' => $data['1']['value'],
        );
        $update_post = wp_update_post($mypost);

    } elseif ($actualTemplate == 'players') {
        // ANCIENNES LISTES
        $oldplayerlist = get_team_meta($post_id);
        $oldplayerlist = $oldplayerlist['joueurs'];

        // NOUVELLES LISTES
        foreach($data as $playerid) {
            $playersList[] = $playerid;
        };

        foreach($oldplayerlist as $oldplayer){
            if (!in_array($oldplayer, $playersList)) {
                // RETRAIT DU JOUEUR
                $author = get_post($oldplayer);
                $author = $author->post_author;

                $player_data = get_player_meta($author);

                $teams = $player_data['teams_ids'];
                $key = array_search($post_id, $teams);
                unset($teams[$key]);
                $teams = json_encode($teams);
                update_field('player_teams', $teams, 'user_'.$author);
            };
        };

        foreach($playersList as $newplayer){
            if (!in_array($newplayer, $oldplayerlist)) {
                // AJOUT DU JOUEUR
                $author = get_post($newplayer);
                $author = $author->post_author;

                $player_data = get_player_meta($author);

                $teams = $player_data['teams_ids'];
                if (gettype($teams) == 'string') {
                    $teams = [];
                    $teams[] = $post_id;
                } else {
                    $teams[] = $post_id;
                };
                $teams = json_encode($teams);
                update_field('player_teams', $teams, 'user_'.$author);
            };
        };
        
        $playersListJSON = json_encode($playersList);
        update_field('post_players', $playersListJSON, $post_id);

    } elseif ($actualTemplate == 'palmares') {
        $palmares = array_chunk($data, 5);
        $palmaresNumber = count($palmares);
        if (!empty($palmares)) {
            foreach($palmares as $uniquepalmares) {
                $maj_palmares['palmares-name'] = $uniquepalmares['0']['value'];
                $maj_palmares['palmares-place'] = $uniquepalmares['1']['value'];
                $maj_palmares['palmares-game'] = $uniquepalmares['2']['value'];
                $maj_palmares['palmares-description'] = $uniquepalmares['3']['value'];
                if(!empty($maj_palmares['palmares-name'])){
                    $newpalmares[] = $maj_palmares;                            
                };
            };
        };
        $newpalmares = json_encode($newpalmares);
        update_field('post_palmares', $newpalmares, $post_id);

    } elseif ($actualTemplate == 'addpalmares') {
        $previouspalmares = $meta['palmares'];
        if (!empty($data['0']['value'])) {
                $new_palmares['palmares-name'] = $data['0']['value'];
                $new_palmares['palmares-place'] = $data['1']['value'];
                $new_palmares['palmares-game'] = $data['2']['value'];
                $new_palmares['palmares-description'] = $data['3']['value'];
                $previouspalmares[] = $new_palmares;
            };         
        $previouspalmares = json_encode($previouspalmares); 
        update_field('post_palmares', $previouspalmares, $post_id);
    };

    get_template_part('template-part/edit-team/content', $req);

    wp_die();

};

add_action( 'wp_ajax_load_player_stats', 'load_player_stats' );
add_action( 'wp_ajax_nopriv_load_player_stats', 'load_player_stats' );

function load_player_stats() {
    $id = $_POST['post-id'];
    $game = $_POST['game'];
    get_template_part('template-part/single-player/content', $game);
    wp_die();
};

add_action( 'wp_ajax_upload_files_team', 'upload_files_team' );
add_action( 'wp_ajax_nopriv_upload_files_team', 'upload_files_team' );

function upload_files_team() {

    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $uploadedfile = $_FILES['file'];
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    basename($movefile['file']);
    
    if ($movefile && !isset($movefile['error'])) {
        echo "File Upload Successfully";
        $post = $_POST['post'];
        update_field('post_'.$_POST['type'], basename($movefile['file']), $post);
    } else {
        echo $movefile['error'];
    }

    wp_die();
};

add_action( 'wp_ajax_leave_team', 'leave_team' );
add_action( 'wp_ajax_nopriv_leave_team', 'leave_team' );

function leave_team() {
    $current_user_id = get_current_user_id();
    $current_player = get_current_player($current_user_id);
    $team_id = $_POST['team-id'];

    $playerMeta = get_player_meta($current_user_id);
    $teamMeta = get_team_meta($team_id);

    // RETRAIT DU JOUEUR A L'EQUIPE
    $key = array_search($current_player, $teamMeta['joueurs']);
    unset($teamMeta['joueurs'][$key]);
    $joueurs = json_encode($teamMeta['joueurs']);
    update_field('post_players', $joueurs, $team_id);

    // RETRAIT DE l'EQUIPE AU JOUEUR
    $key = array_search($team_id, $playerMeta['teams_ids']);
    unset($playerMeta['teams_ids'][$key]);
    $teams = json_encode($playerMeta['teams_ids']);
    update_field('player_teams', $teams, 'user_'.$current_user_id);

    wp_die();
};

add_action( 'wp_ajax_load_team_infos', 'load_team_infos' );
add_action( 'wp_ajax_nopriv_load_team_infos', 'load_team_infos' );

function load_team_infos() {
    $infos = $_POST['type'];
    $team = $_POST['post-id'];
    $teamMeta = get_team_meta($team);
    if($infos == 'all') {
        json_encode($infos);
        echo $infos;
    } else {
        $infos = $teamMeta['title'];
        echo $infos;
    };
    wp_die();
};
?>