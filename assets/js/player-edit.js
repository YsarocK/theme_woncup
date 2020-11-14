jQuery(document).ready(function($){

    let actualFields = $('#current_infos').serializeArray();
    let actualTemplate = $('#current_infos').attr('infos');
    let roles = "";

    $(document).ajaxStart(function(){
        $('.loading').css('display', 'flex');
        $('.lds-ring').css('display', 'flex');
    });

    $(document).ajaxComplete(function(){
        $('.loading').css('display', 'none');
        $('.lds-ring').css('display', 'none');
        changeBorder();
    });

    function changeBorder(){
        var border = $('#current_infos').attr('infos');
        console.log(border);
        $('#about').css('border', 'none');
        $('#social').css('border', 'none');
        $('#games').css('border', 'none');
        $('#experiences').css('border', 'none');
        $('#addexperience').css('border', 'none');
        $('#'+border).css('border-bottom', 'solid 2px #3491ca');
    };

    $('#current_infos').change(function(){
        changeBorder();
    });


    function getTemplate(nextTemplate) {
        actualFields = $('#current_infos').serializeArray();
        actualTemplate = $('#current_infos').attr('infos');
        if(actualTemplate == 'about'){
            if(document.getElementById('myfile').files.length != 0) {
                upload_file('#myfile', 'user');
            };
        } else if(actualTemplate == 'games') {
            roles = $('#role-lol').serializeArray();
        }
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_player',
                'req' : nextTemplate,
                'actualTemplate' : actualTemplate,
                'data' : actualFields,
                'roles' : roles,
            }
        }).done(function(response) {
            $('#current_infos').html('');
            $('#current_infos').html(response);
            $('#current_infos').attr('infos', nextTemplate);
            if(nextTemplate == 'about') {
                getCurrentProfilPicture();
            };
        });
    }

    // MENU APPELANT LE BON TEMPLATE
    $('#edit-player-menu').find('li').each(function(){
        var val = $(this).attr('id');
        $(this).click(function(){
            getTemplate(val);
        })
    })
    
    // REQUETE POUR LA PHOTO DE PROFIL
    function getCurrentProfilPicture() {
        $.ajax({
            url: ajaxurl,
            type: "POST",
            global: false,
            data: {
            'action': 'load_user_picture',
            }
        }).done(function(response) {
            url = 'url(' + response + ")";
            $('.icon-picture').css('background', url);
            $('.icon-picture').css('background-size', 'cover');
            $('.icon-picture').css('background-position', 'center');
        });
    };

    // APPEL DE LA PHOTO DE PROFIL
    if ($('.icon-picture').length){
        getCurrentProfilPicture();
    };

    // FONCTION D'UPLOAD DE FICHIER AVEC AJAX
    function upload_file(file_id, post) {
        var file = new FormData();
        file.append( "file", $(file_id)[0].files[0]);
        file.append( "action", 'upload_file');  
        file.append( "post", post);  

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

    // ENREGISTREMENT DES DONNEES AVANT RELOAD
    function save_data(){
        actualFields = $('#current_infos').serializeArray();
        actualTemplate = $('#current_infos').attr('infos');
        if(actualTemplate == 'about'){
            if(document.getElementById('myfile').files.length != 0) {
                upload_file('#myfile', 'user');
            };
            roles = $('#role-lol').serializeArray();
        }
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_player',
                'req' : 'reload',
                'actualTemplate' : actualTemplate,
                'data' : actualFields,
                'roles' : roles,
            }
        }).done(function(response) {
            window.location.reload();
        });
    }

    $('#datasubmit').click(function(){
        save_data();
    });

    // PRISE EN CHARGE DU BUTTON D'UPLOAD
    $('.upload-button').click(function(){
        var closestInput = $(this).closest(".div-100").find(".upload-input");
        closestInput.trigger('click');

    });

    $('.upload-input').change(function(){
        var closestUploaded = $(this).closest(".div-100").find(".uploaded-file");
        closestUploaded.html($(this).closest(".div-100").find(".upload-input")[0].files[0].name);
    });
});
