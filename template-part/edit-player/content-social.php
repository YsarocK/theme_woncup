<?php
global $games_supported;
$current_user_id = get_current_user_id();
$meta = get_player_meta($current_user_id);
?>

<div class="div-100">
    <label for="twitter"><i class="fab fa-twitter"></i> Twitter</label>
    <div class="div-100 social_links_container">
        <p>https://www.twitter.com/</p>
        <input class="div-50" name="twitter" type="text" id="twitter" value="<?php if(!empty($meta['social_links']['twitter']['url'])) { echo $meta['social_links']['twitter']['url'];}?>" />
    </div>
</div>

<div class="div-100">
    <label for="linkedin"><i class="fab fa-linkedin-in"></i> Linkedin</label>
    <div class="div-100 social_links_container">
        <p>https://www.linkedin.com/in/</p>
        <input class="div-50" name="linkedin" type="text" id="linkedin" value="<?php if(!empty($meta['social_links']['linkedin']['url'])) { echo $meta['social_links']['linkedin']['url'];}?>" />
    </div>
</div>

<div class="div-100">
    <label for="instagram"><i class="fab fa-instagram"></i> Instagram</label>
    <div class="div-100 social_links_container">
        <p>https://www.instagram.com/</p>
        <input class="div-50" name="instagram" type="text" id="instagram" value="<?php if(!empty($meta['social_links']['instagram']['url'])) { echo $meta['social_links']['instagram']['url'];}?>" />
    </div>
</div>

<div class="div-100">
    <label for="discord"><i class="fab fa-instagram"></i> Discord</label>
    <div class="div-100 social_links_container">
        <p>https://www.discord.com/</p>
        <input class="div-50" name="discord" type="text" id="discord" value="<?php if(!empty($meta['social_links']['discord']['url'])) { echo $meta['social_links']['discord']['url'];}?>" />
    </div>
</div>