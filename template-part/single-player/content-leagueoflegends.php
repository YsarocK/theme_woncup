<?php 
$playerid = $_POST['post-id'];
$author = get_post($playerid);
$author = $author->post_author;
$player = get_player_meta($author);
$playerid = $player['leagueoflegends']['pseudo'];

$meta = get_lol_stats($playerid);

$s = $meta['name'];
$league = $meta['league'];
$masteries = $meta['masteries'];
$tier = $league[0]->{'tier'};
$rank = $league[0]->{'rank'};
$win = $league[0]->{'wins'};
$losses = $league[0]->{'losses'};
$winrate = round(($win/($win+$losses))*100);
$champions = $meta['object'];

?>


<div class="player_container">
    <div class="league">
        <div class="lol_rank">
            <div class="level">
                <div class="rank_lvl">
                    <?php if (empty($league)): ?>
                        <p>Non classé</p>
                    <?php else: ?>
                        <label>tier</label> 
                        <p><?=$tier?> <?=$rank?></p>
                    <?php endif ?>
                </div>
                <div class="rank_icon">
                    <?php if (!empty($league)): ?>
                        <img class='emblems' src=<?= get_stylesheet_directory_uri() . '/img/emblems/Emblem_'.$tier.'.png'?>>
                    <?php endif ?>
                </div>
            </div>
            <div class="player_roles">
                <?php foreach ($player['leagueoflegends']['roles'] as $role) { ?>
                    <img class='roles' src=<?= get_stylesheet_directory_uri() . '/img/roles/role_'.$role.'.png'?>>  
                <?php } ?>
            </div>
        </div>
        <div class="winrate">
            <label for="">Winrate</label>
            <canvas id="winrate"></canvas>
            <div class="winrate_bar">
                <div id='wins'><?=$winrate?></div>
                <div id='losses'><?=(100 - $winrate)?></div>
            </div>
        </div>
        <div class="championsMasteries">
            <label for="">Meilleurs champions</label>
            <div class="champions_container">
            <?php foreach($champions as $champion) {?>
                <div class="uniquechampion">
                    <img class='championImg' src="<?= $champion['img'] ?>" alt="">
                    <p class="championName"><?= $champion['details']->name?></p>
                    <p><?= $champion['points'] ?></p>
                    <div class="mastery">
                        <p><?= $champion['mastery'] ?></p>
                        <img class="masteryemblem" src='<?= get_stylesheet_directory_uri() . "/img/mastery_".$champion['mastery'].".png"?>' alt="">
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>