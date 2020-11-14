<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <?php wp_head(); ?>
</head>

<?php
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>
​
<body <?php body_class(); ?>>
<div class='loading'><div class="lds-ring"><div></div><div></div><div></div><div></div></div>
</div>
<?php get_sidebar('woncup') ?>
  <div class='woncup_container'>
        <header class="header-custom">
            <div class="header-container">
                <div id="mobile_menu_btn"></div>
                <div id="currentUser">
                    <?=get_search_form()?>
                    <a href="<?= get_players_permalink($current_user_id) ?>"><div class="icon-picture header-icon-picture"><img src="<?= wc_current_user_picture() ?>" alt=""></div></a>
                    <p><?=$meta['pseudo']?></p>
                    <?php wp_head(); ?>
                </div>
            </div>
        </header>
        <div class="woncup_content">
            <?php wp_body_open() ?>

