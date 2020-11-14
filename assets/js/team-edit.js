jQuery(document).ready(function($){

    let actualFields = $('#current_infos').serializeArray();
    let actualTemplate = $('#current_infos').attr('infos');
    let postid = $('#edit-team-menu').attr('post-id');

    let playerId = "";
    let divId = "";
    let parentdiv = "";

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
            divId = '#'+id;
            url = 'url(' + response + ")";
            $(divId).css('background', url);
            $(divId).css('background-size', 'cover');
            $(divId).css('background-position', 'center');
        });
    }

    function getTemplate(nextTemplate) {
        actualFields = $('#current_infos').serializeArray();
        actualTemplate = $('#current_infos').attr('infos');
        postid = $('#edit-team-menu').attr('post-id');
        if(actualTemplate == 'players'){
            actualFields = [];
            $('.unique_player').each(function(){
                playerId = $(this).attr('player-id');
                if(actualFields.includes(playerId) == false && playerId != "default") {
                    actualFields.push(playerId);
                }
            });
            $('.new_player').each(function(){
                playerId = $(this).val();
                if(actualFields.includes(playerId) == false && playerId != "default") {
                    actualFields.push(playerId);
                }
            });
            console.log(actualFields);
        } else if(actualTemplate == 'about') {
            if(document.getElementById('picture').files.length != 0) {
                upload_file('#picture', postid, 'picture');
                console.log('ca passe');
            };
            if(document.getElementById('baneer').files.length != 0) {
                upload_file('#baneer', postid, 'baneer');
                console.log('ca passe 2');
            };
        };
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_team',
                'req' : nextTemplate,
                'actualTemplate' : actualTemplate,
                'data' : actualFields,
                'post-id' : postid,
            }
        }).done(function(response) {
            $('#current_infos').html('');
            $('#current_infos').html(response);
            $('#current_infos').attr('infos', nextTemplate);
            // if(nextTemplate == 'about') {
            //     getCurrentProfilPicture();
            // }
            $('#about').css('border', 'none');
            $('#players').css('border', 'none');
            $('#palmares').css('border', 'none');
            $('#addpalmares').css('border', 'none');
            $('#'+nextTemplate).css('border-bottom', 'solid 2px #3491ca');
            if(nextTemplate == 'players'){
                $('.player_icon').each(function(){
                    playerId = $(this).attr('id');
                    getPlayerIcon(playerId);
                    // console.log(playerId);
                });
                $(".deletePlayer").click(function(){
                    parentdiv = $(this).closest('.div-100');
                    console.log(parentdiv);
                    parentdiv.remove();
                });
            };
        });
    }

    $('#about').click(function(){
        getTemplate('about');
    });
    $('#players').click(function(){
        getTemplate('players');
    });
    $('#palmares').click(function(){
        getTemplate('palmares');
    });
    $('#addpalmares').click(function(){
        getTemplate('addpalmares');
    });

    function save_data(){
        actualFields = $('#current_infos').serializeArray();
        actualTemplate = $('#current_infos').attr('infos');
        postid = $('#edit-team-menu').attr('post-id');
        if(actualTemplate == 'players'){
            actualFields = [];
            $('.unique_player').each(function(){
                playerId = $(this).attr('player-id');
                if(actualFields.includes(playerId) == false && playerId != "default") {
                    actualFields.push(playerId);
                }
            });
            $('.new_player').each(function(){
                playerId = $(this).val();
                if(actualFields.includes(playerId) == false && playerId != "default") {
                    actualFields.push(playerId);
                }
            });
            console.log(actualFields);
        } else if(actualTemplate == 'about') {
            if(document.getElementById('picture').files.length != 0) {
                upload_file('#picture', postid, 'picture');
                console.log('ca passe');
            };
            if(document.getElementById('baneer').files.length != 0) {
                upload_file('#baneer', postid, 'baneer');
                console.log('ca passe 2');
            };
        };
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_team',
                'req' : 'reload',
                'actualTemplate' : actualTemplate,
                'data' : actualFields,
                'post-id' : postid,
            }
        }).done(function(response) {
            window.location.reload();
        });
    }

    $('#datasubmit').click(function(){
        save_data();
    });

    // SUPPRESSION DES EXPERIENCES
    function deletePalmares(index_val){
        var div_id = 'past_palmares_'+index_val;
        $('#'+div_id).remove();
    }

    window.deletePalmares = deletePalmares;

    // UPLOAD FILE
    function upload_file(file_id, post, type) {
        var file = new FormData();
        file.append( "file", $(file_id)[0].files[0]);
        file.append( "action", 'upload_files_team');  
        file.append( "post", post);
        file.append( "type", type);  

        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: file,
            processData: false,
            contentType: false,
        }).done(function(response) {
            $('#imgURL').html(response);
        });
    };

    $('.upload-button').click(function(){
        var closestInput = $(this).closest(".div-50").find(".upload-input");
        closestInput.trigger('click');

    });

    $('.upload-input').change(function(){
        var closestUploaded = $(this).closest(".div-50").find(".uploaded-file");
        console.log(closestUploaded);
        closestUploaded.html($(this).closest(".div-50").find(".upload-input")[0].files[0].name);
    });
});
