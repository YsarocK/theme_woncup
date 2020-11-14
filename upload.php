<?php /* Template Name: PlayerTeams */ ?>
<?php
get_header();
add_action( 'wp_enqueue_scripts', wp_enqueue_script( 'upload', get_stylesheet_directory_uri()."/assets/upload.js", array( 'jquery' ), '1.0', true ));
?>

<form action="" id="myForm">
    <input class="div-100" type="file" name="picture" id="myfile">
    <p id="upload">Upload image</p>
</form>

<?php
get_footer();
?>


