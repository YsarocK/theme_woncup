<?php
/*
Template Name : Inscription
*/

get_header('minimal');
add_action( 'wp_enqueue_styles', wp_enqueue_style( 'login-register', get_stylesheet_directory_uri() . '/assets/css/login-register.css', array(), NULL, NULL));

$error = false;

if (is_user_logged_in()) {
	player_redirect_to_profile();
};

if(!empty($_POST)) {
    if($_POST['user_password'] != $_POST['user_password2']) {
        $error = "Les mots de passe ne correspondent pas";
    } else {
        if(!is_email($_POST['user_email'])) {
            $error = "Veuillez entrer un email valide";
        } else {
            $user = array(
                'user_login' => $_POST['user_login'],
                'user_pass' => $_POST['user_password'],
                'user_email' => $_POST['user_email'],
            );
			$user_add = wp_insert_user($user);
			if (is_wp_error($user_add)) {
				$error = $user_add->get_error_message();
			} else {
				update_field('player_pseudo', $_POST['user_login'], 'user_'.$user_add);
				$user = array(
					'user_login' => $_POST['user_login'],
					'user_password' => $_POST['user_password'],
                    'user_email' => $_POST['user_email'],
                    'remember' => false,
                );
                if (!empty ($_POST['remember'])) {
                    $userlog['remember'] = true;
                };
				$user_login = wp_signon($user);
                do_action('template_redirect', $user_login);
                setcookie("firstVisit", 'true', time() + 60);
                player_redirect_to_profile();
				if(is_wp_error($user_login)){
					$error = $user_login->get_error_message();
					print_r($error);
				} else {
                    update_field('player_pseudo', $_POST['user_login'], 'user_'.$user_login);
				}
			}
        }
    }
}

?>

<div class="form-login">

    <div class="container-form-login">
        <h2>S'inscrire</h2>

        <div class="form_logo">
            
        </div>

        <?php if($error) {?>
        <div class="error">
            <?= $error ?>
        </div>
        <?php } ?>

        <form method="POST">

            <label for="user_login">Pseudo</label>
            <input type="text" name="user_login" id="user_login">

            <label for="user_email">Email</label>
            <input type="text" name="user_email" id="user_email">

            <label for="user_password">Mot de passe</label>
            <input type="password" name="user_password" id="user_password">

            <label for="user_password2">Confirmez le mot de passe</label>
            <input type="password" name="user_password2" id="user_password2">

            <div class="remember-button">            
                <div class="remember-button-replace"></div>
                <label for="remember">Se souvenir de moi</label>
                <input type="checkbox" name="remember" id="remember">
            </div>

            <input type="submit" name="button1" value="S'inscrire" id='save'/>
            <p style="margin-top: 5px">Vous avez déjà un compte ?<a href="http://woncup.net/login"> Se connecter</a></p>
        </form>
    </div>

    <div class="side-picture">
    </div>

</div>

<?php get_footer('minimal'); ?>