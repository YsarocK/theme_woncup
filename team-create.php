<?php /* Template Name: CreerUneEquipe */ ?>
<?php

if (!is_user_logged_in()) {
	header("Location : /login");
};
get_header();
add_action( 'wp_enqueue_scripts', wp_enqueue_script( 'create-team', get_stylesheet_directory_uri()."/assets/js/team-create.js", array( 'jquery' ), '1.0', true ));
add_action( 'wp_enqueue_styles', wp_enqueue_style( 'team-create', get_stylesheet_directory_uri() . '/assets/css/team-create.css', array(), NULL, NULL));

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <div class="page_container">
            <div class="form_container">
                <form id="current_infos" method="POST" enctype="multipart/form-data" infos="about">
                    <?php get_template_part('template-part/create-team/content', 'about'); ?>                
                </form>
            </div>
            <div id='next-step'>
                <p >Etape suivante </p>
                <i class="fas fa-angle-right"></i>
            </div>
    </div>
    <?php
get_footer();
?>