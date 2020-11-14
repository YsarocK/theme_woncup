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

    let playerId = "";
    let divId = "";

    function getPlayerIcon(id) {
        $.ajax({
            url: ajaxurl,
            type: "POST",
            global: false,
            data: {
            'action': 'load_player_picture',
            'post_id' : id,
            }
        }).done(function(response) {
            console.log(response);
            divId = '#'+id;
            url = 'url(' + response + ")";
            $(divId).css('background', url);
            $(divId).css('background-size', 'cover');
            $(divId).css('background-position', 'center');
        });
    }
    $('.player_icon').each(function(){
        playerId = $(this).attr('id');
        console.log(playerId);
        getPlayerIcon(playerId);
        // console.log(playerId);
    });

    // REQUEST EXPERIENCES
    let palmares = "";
    let uniquepalmares = "";
    let i = 0;
    let count = i+1;
    let numberOfPalmares = 0;
    let id = $('#team_container').attr('post-id');
    $('#palmCount').html(count);

    function displayPalmares() {
        uniquepalmares = palmares[i];
        $('#palmares-name').html(uniquepalmares['palmares-name']);
        $('#palmares-place').html(uniquepalmares['palmares-place']);
        $('#palmares-game').html(uniquepalmares['palmares-game']);
        $('#palmares-description').html(uniquepalmares['palmares-description']);
    }

    function getPalmares() {
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
            'action': 'load_team_palmares',
            'post_id' : id,
            }
        }).done(function(response) {
            palmares = JSON.parse(response);
            console.log(palmares);
            if(palmares ==  null){
                $('#team-palmares').html('Aucune expérience renseignée');
                $("#next-experience").remove();
                $("#previous-experience").remove();
            } else {
                numberOfTeam = palmares.length;
                if(numberOfPalmares == 1){
                    $("#next-experience").remove();
                    $("#previous-experience").remove();
                }
                displayPalmares();
            }
        });
    }
    if($("#next-experience").length){
        getPalmares();

        $("#next-experience").click(function() {
            if (i => 0) {
                if (i < numberOfPalmares-1) {
                    i = i+1;
                    displayPalmares();
                    count = count+1;
                    $('#palmCount').html(count);
                }
            }
        });

        $("#previous-experience").click(function() {
            if (i => 1) {
                if (i <= numberOfPalmares) {
                    i = i-1;
                    displayPalmares();
                    count = count-1;
                    $('#palmCount').html(count);
                }
            }
        });
    };
    getPalmares();

    // REQUEST PROFIL PICTURE
    function getProfilPicture(type, concernedDiv) {
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
            'action': 'load_teams_pictures',
            'post-id' : id,
            'type' : type,
            }
        }).done(function(response) {
            console.log(response);
            url = 'url(' + response + ")";
            $(concernedDiv).css('background', url);
            $(concernedDiv).css('background-size', 'cover');
            $(concernedDiv).css('background-position', 'center');
        });
    }

    getProfilPicture('baneer', '#team_banner');
    getProfilPicture('picture', '#team_logo');
});