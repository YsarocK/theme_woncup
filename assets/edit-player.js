jQuery(document).ready(function($){

    let actualFields = $('#current_infos').serializeArray();
    let actualTemplate = $('#current_infos').attr('infos');

    function getTemplate(nextTemplate) {
        actualFields = $('#current_infos').serializeArray();
        actualTemplate = $('#current_infos').attr('infos');
        if(actualTemplate == 'about'){
            if(document.getElementById('myfile').files.length != 0) {
                upload_file('#myfile', 'user');
                console.log('ca passe');
            }
        }
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_player',
                'req' : nextTemplate,
                'actualTemplate' : actualTemplate,
                'data' : actualFields,
            }
        }).done(function(response) {
            $('#current_infos').html('');
            $('#current_infos').html(response);
            $('#current_infos').attr('infos', nextTemplate);
            if(nextTemplate == 'about') {
                getCurrentProfilPicture();
            }
            $('#about').css('border', 'none');
            $('#social').css('border', 'none');
            $('#experiences').css('border', 'none');
            $('#editexperience').css('border', 'none');
            $('#'+nextTemplate).css('border-bottom', 'solid 1px #3491ca');
        });
    }

    $('#about').click(function(){
        getTemplate('about');
    });
    $('#social').click(function(){
        getTemplate('social');
    });
    $('#experiences').click(function(){
        getTemplate('experiences');
    });
    $('#addexperience').click(function(){
        getTemplate('addexperience');
    });
    
    // function getCurrentProfilPicture() {
    //     $.ajax({
    //         url: ajaxurl,
    //         type: "POST",
    //         global: false,
    //         data: {
    //         'action': 'load_user_picture',
    //         }
    //     }).done(function(response) {
    //         url = 'url(' + response + ")";
    //         $('.icon-picture').css('background', url);
    //         $('.icon-picture').css('background-size', 'cover');
    //         $('.icon-picture').css('background-position', 'center');
    //     });
    // };

    // if ($('.icon-picture').length){
    //     getCurrentProfilPicture();
    // };

    function upload_file(file_id, post) {
        console.log("uploadfunction");
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

    function save_data(){
        actualFields = $('#current_infos').serializeArray();
        actualTemplate = $('#current_infos').attr('infos');
        if(actualTemplate == 'about'){
            if(document.getElementById('myfile').files.length != 0) {
                upload_file('#myfile', 'user');
                console.log('ca passe');
            }
        }
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_player',
                'req' : 'reload',
                'actualTemplate' : actualTemplate,
                'data' : actualFields,
            }
        }).done(function(response) {
            window.location.reload();
        });
    }

    $('#datasubmit').click(function(){
        save_data();
    })

    // $("#current_infos").submit(function(e) {
    //     e.preventDefault();
    // });
});
