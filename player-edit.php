<?php /* Template Name: EditerUnJoueur */ ?>
<?php
if (!is_user_logged_in()) {
	header("Location : /login");
};
get_header();
add_action( 'wp_enqueue_scripts', wp_enqueue_script( 'edit-player', get_stylesheet_directory_uri()."/assets/js/player-edit.js", array( 'jquery' ), '1.0', true ));
add_action( 'wp_enqueue_styles', wp_enqueue_style( 'player-edit', get_stylesheet_directory_uri() . '/assets/css/player-edit.css', array(), NULL, NULL));
$section = $_GET['section'];
if ($section == "about" || $section == "games" || $section == "social"  || $section == "experiences"  || $section == "addexperience") {
     
} else {
    $section = 'about';
};

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <div class="page_container">
        <ul id='edit-player-menu' post-id='<?=get_the_ID()?>'>
            <li id='about'>A propos de vous</li>
            <li id='games'>Jeux</li>
            <li id='social'>Réseaux sociaux</li>
            <li id='experiences'>Experiences</li>
            <li id='addexperience'>Ajouter une experience</li>
        </ul>
        <div class="form_container">
            <form id="current_infos" method="POST" enctype="multipart/form-data" infos="<?=$section?>">
                <?php  
                    get_template_part('template-part/edit-player/content', $section); 
                ?>         
            </form>
            <p id='imgURL'></p>
            <div class="div-100">
                <input type='submit' value='Enregistrer' id="datasubmit">     
            </div>  
        </div>
    </div>
    <?php
get_footer();
?>