<?php /* Template Name: TeamEdit */ ?>
<?php get_header(); ?>
<?php add_action( 'wp_enqueue_styles', wp_enqueue_style( 'my-player-teams', get_stylesheet_directory_uri() . '/assets/css/team-edit.css', array(), NULL, NULL));
    add_action( 'wp_enqueue_scripts', wp_enqueue_script( 'team-edit', get_stylesheet_directory_uri()."/assets/js/team-edit.js", array( 'jquery' ), '1.0', true ));

$current_user_id = get_current_user_id();
$teamid = $_GET['id'];
$meta  = get_team_meta($teamid);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <div class="page_container">
        <ul id='edit-team-menu' post-id='<?=$teamid?>'>
            <li id='about'>A propos de l'équipe</li>
            <li id='players'>Joueurs</li>
            <li id='palmares'>Palmarès</li>
            <li id='addpalmares'>Ajouter une experience</li>
        </ul>
        <div class="form_container">
            <form id="current_infos" method="POST" enctype="multipart/form-data" infos="about">        
            <div class="div-50">
                <label for="">Photo de profil</label>
                <div class="upload-button"><i class="fas fa-file-import"></i>Mettre à jour l'image de profil</div>
                <input class="upload-input" type="file" name="picture" id="picture" accept="image/gif, image/jpeg, image/png">
                <p class="uploaded-file"></p>
            </div>
            <div class="div-50">
                <label for="">Bannière</label>
                <div class="upload-button"><i class="fas fa-file-import"></i>Mettre à jour la bannière</div>
                <input class="upload-input" type="file" name="baneer" id="baneer" accept="image/gif, image/jpeg, image/png">
                <p class="uploaded-file"></p>
            </div>
            <div class="div-100">
                <label for="">Nom de l'équipe</label>
                <input type="text" value="<?= $meta['title'] ?>" name="nom">
            </div>
            <div class="div-100">
                <label for="">Description</label>
                <textarea name="descritpion" id="" cols="30" rows="10"><?= $meta['description'] ?></textarea>
            </div>
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
