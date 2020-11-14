<?php
/*
Template Name : Connexion
*/

get_header('minimal');
add_action( 'wp_enqueue_styles', wp_enqueue_style( 'login-register', get_stylesheet_directory_uri() . '/assets/css/login-register.css', array(), NULL, NULL));

if (is_user_logged_in()) {
	player_redirect_to_profile();
};

$error = false;

if(!empty($_POST)) {
    $userlog = array(
        'user_login' => $_POST['user_login'],
        'user_password' => $_POST['user_password'],
        'remember' => false,
    );
    if (!empty ($_POST['remember'])) {
        $userlog['remember'] = true;
    };
	$user = wp_signon($userlog);
	do_action('template_redirect', $user);
    if(is_wp_error($user)){
        $error = $user->get_error_message();
		print_r($user);
    }else{                
        do_action('template_redirect', setcookie("firstVisit", 'true', time() + 60));
        player_redirect_to_profile();
    };
}
?>

<div class="form-login">

    <div class="container-form-login">

        <h2>Se connecter</h2>
        <div class="form_logo">

        </div>

        <?php if($error) {?>
        <div class="error">
            <?php echo $error ?>
        </div>
        <?php } ?>

        <form action="<?= $_SERVER['REQUEST_URI'];?>" method="POST">

            <label for="user_login">Identifiant</label>
            <input type="text" name="user_login" id="user_login">

            <label for="user_password">Mot de passe</label>
            <input type="password" name="user_password" id="user_password">

            <div class="remember-button">            
                <div class="remember-button-replace"></div>
                <label for="remember">Se souvenir de moi</label>
                <input type="checkbox" name="remember" id="remember">
            </div>

            <input type="submit" name="button1" value="Se connecter" id='save'/>
            <p style="margin-top: 5px">Vous n'avez pas de compte ?<a href="http://woncup.net/register"> S'inscrire</a></p>
        </form>

    </div>

    <div class="side-picture">
    </div>

</div>

<?php get_footer('minimal'); ?>