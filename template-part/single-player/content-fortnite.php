<?php 
$playerid = $_POST['post-id'];
$author = get_post($playerid);
$author = $author->post_author;
$username = get_field('player_fortnite', 'user_'.$author);
$player = get_player_meta($author);

$meta = get_fortnite_stats($username);
$solo = $meta['data']['stats']['keyboardMouse']['solo'];
$duo = $meta['data']['stats']['keyboardMouse']['duo'];
$squad = $meta['data']['stats']['keyboardMouse']['squad'];

?>

<div class="player_container">
    <div class="league">
        <div class="solo_stats fortnite_container">
            <label for="">Solo</label>
            <div>
                <div>
                    <label for="">Wins</label>
                    <p><?=$solo['wins']?></p>
                </div>
                <div>
                    <label for="">Top 10</label>
                    <p><?=$solo['top10']?></p>
                </div>
                <div>
                    <label for="">Kill per match</label>
                    <p><?=$solo['killsPerMatch']?></p>
                </div>
                <div>
                    <label for="">KD</label>
                    <p><?=$solo['kd']?></p>
                </div>
                <div>
                    <label for="">Winrate</label>
                    <p><?=$solo['winRate']?></p>
                </div>
                <div>
                    <label for="">Matches</label>
                    <p><?=$solo['matches']?></p>
                </div>
            </div>
        </div>
        <div class="duo_stats fortnite_container">
            <label for="">Duo</label>
            <div>
                <div>
                    <label for="">Wins</label>
                    <p><?=$duo['wins']?></p>
                </div>
                <div>
                    <label for="">Top 5</label>
                    <p><?=$duo['top5']?></p>
                </div>
                <div>
                    <label for="">Kill per match</label>
                    <p><?=$duo['killsPerMatch']?></p>
                </div>
                <div>
                    <label for="">KD</label>
                    <p><?=$duo['kd']?></p>
                </div>
                <div>
                    <label for="">Winrate</label>
                    <p><?=$duo['winRate']?></p>
                </div>
                <div>
                    <label for="">Matches</label>
                    <p><?=$duo['matches']?></p>
                </div>
            </div>
        </div>
        <div class="squad_stats fortnite_container">
            <label for="">Squad</label>
            <div>
                <div>
                    <label for="">Wins</label>
                    <p><?=$squad['wins']?></p>
                </div>
                <div>
                    <label for="">Top 3</label>
                    <p><?=$squad['top3']?></p>
                </div>
                <div>
                    <label for="">Kill per match</label>
                    <p><?=$squad['killsPerMatch']?></p>
                </div>
                <div>
                    <label for="">KD</label>
                    <p><?=$squad['kd']?></p>
                </div>
                <div>
                    <label for="">Winrate</label>
                    <p><?=$squad['winRate']?></p>
                </div>
                <div>
                    <label for="">Matches</label>
                    <p><?=$squad['matches']?></p>
                </div>
            </div>
        </div>
    </div>
</div>