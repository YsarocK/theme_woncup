jQuery(document).ready(function($){

    $(document).ajaxStart(function(){
        $('#current_infos').css('display', 'none');
        $('.loading').css('display', 'flex');
        $('.lds-ring').css('display', 'flex');
    });

    $(document).ajaxComplete(function(){
        $('#current_infos').css('display', 'flex');
        $('.loading').css('display', 'none');
        $('.lds-ring').css('display', 'none');
    });

    // REQUEST EXPERIENCES
    let experiences = "";
    let experience = "";
    let i = 0;
    let count = i+1;
    let numberOfTeam = 0;
    let id = $('#player-profile').attr('post-id');
    $('#expCount').html(count);

    function displayExperience() {
        experience = experiences[i];
        $('#team-name').html(experience['team-name']);
        $('#team-game').html(experience['team-game']);
        $('#team-role').html(experience['team-role']);
        $('#team-description').html(experience['team-description']);
        $('#team-palmares').html(experience['team-palmares']);
    }

    function getExperiences() {
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
            'action': 'load_user_experiences',
            'post_id' : id,
            }
        }).done(function(response) {
            experiences = JSON.parse(response);
            if(experiences ==  null){
                $('#player-experiences').html('Aucune expérience renseignée');
                $("#next-experience").remove();
                $("#previous-experience").remove();
            } else {
                numberOfTeam = experiences.length;
                if(numberOfTeam == 1){
                    $("#next-experience").remove();
                    $("#previous-experience").remove();
                }
                displayExperience();
            }
        });
    }
    if($("#next-experience").length){
        getExperiences();

        $("#next-experience").click(function() {
            // console.log(numberOfTeam);
            if (i => 0) {
                if (i < numberOfTeam-1) {
                    i = i+1;
                    displayExperience();
                    count = count+1;
                    $('#expCount').html(count);
                }
            }
        });

        $("#previous-experience").click(function() {
            // console.log(numberOfTeam);
            if (i => 1) {
                if (i <= numberOfTeam) {
                    i = i-1;
                    displayExperience();
                    count = count-1;
                    $('#expCount').html(count);
                }
            }
        });
    }

    function load_player_stats(game) {
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
            'action': 'load_player_stats',
            'game': game,
            'post-id' : id,
            }
        }).done(function(response) {
            $('.game_switcher').each(function(){
                $(this).css('background-color', "#181c28");
            });
            $('#'+game).css('background-color', 'white');
            $('#player-stats').html(response);
            if(game == 'leagueoflegends'){
                $('#wins').ready(function(){
                    $('#losses').ready(function(){
                        var losses = $('#losses').text();
                        var wins = $('#wins').text();
                        $('#wins').remove();
                        $('#losses').remove();
                        var ctx = document.getElementById('winrate').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'horizontalBar',
                            data: {
                                datasets: [
                                    {
                                        label: 'Wins',
                                        data: [wins],
                                        backgroundColor: [
                                            '#2ECC71',
                                        ],
                                        borderColor: [
                                            '#2ECC71',
                                        ]
                                    },
                                    {
                                        label: 'Losses',
                                        data: [losses],
                                        backgroundColor: [
                                            '#ff0000',
                                        ],
                                        borderColor: [
                                            '#ff0000',
                                        ]
                                    }
                            ]},
                            options: {
                                layout: {
                                    padding: {
                                        left: 50,
                                        right: 50,
                                        top: 0,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        stacked: true,
                                        barThickness : 50,
                                        barPercentage: 1.0,
                                        categoryPercentage: 1.0,
                                        display: false,
                                    }],
                                    xAxes: [{ 
                                        stacked: true,
                                        barThickness : 50,
                                        barPercentage: 1.0,
                                        categoryPercentage: 1.0,
                                        display: false,
                                    }],
                                },
                                maintainAspectRatio: false,
                            }
                        });
                    });
                });
            };
        });

    }

    load_player_stats('leagueoflegends');

    $('.game_switcher').each(function(){
        var newgame = $(this).attr('id');
        $(this).click(function(){
            load_player_stats(newgame);
        });
    });
      
    $('#pseudo_discord').click(function() {
        $(this).focus();
        $(this).select();
        document.execCommand('copy');
      });

});