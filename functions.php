<?php
include 'ajax.php';

add_action( 'wp_enqueue_scripts', 'ajax_assets' );
function ajax_assets() {
  
    // Charger notre script
    wp_enqueue_script( 'ajax', get_stylesheet_directory_uri()."/assets/js/ajax.js", array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'functions-woncup', get_stylesheet_directory_uri()."/assets/functions.js", array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@9', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'opensans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;700;800&display=swap', array(), NULL, NULL);
    wp_enqueue_script( 'jamicons', 'https://unpkg.com/jam-icons/js/jam.min.js', array( 'jquery' ), '1.0', true );

    // Envoyer une variable de PHP à JS proprement
    wp_localize_script( 'ajax', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
  
}

add_action( 'widgets_init', 'my_custom_sidebar' );
function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Woncup', 'woncup.fr' ),
            'id' => 'woncup',
            'description' => __( 'Sidebar Woncup', 'woncup.fr' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
    }
};

function get_fortnite_stats($username) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://fortnite-api.com/v1/stats/br/v2?name=".$username,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Cookie: __cfduid=d4888e5ac1ad003ee83d3c49de46f72221596889478"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    return $response;
};

function wc_current_user_picture() {

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

};

function wc_player_picture($id) {

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

};

function wc_load_teams_pictures($id) {

    $meta = get_team_meta($id);
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

}
?>