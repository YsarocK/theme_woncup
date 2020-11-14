jQuery(document).ready(function($){
    let template = 0;
    let teaminfos = "";
    let teamplayers = "";
    let teamgames = "";
    let id = "";
    

    function getTemplate(template) {
        actualFields = $('#current_infos').serializeArray();
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                'action': 'load_template_team_creation',
                'req' : template,
                'infos' : teaminfos,
                'players' : teamplayers,
                'games' : teamgames,
            }
        }).done(function(response) {
            $('#current_infos').html('');
            $('#current_infos').html(response);
        });
    }

    $('#next-step').click(function(){
        if(template == 0){
            teaminfos = $('#current_infos').serializeArray();
        }
        if(template == 1){
            teamplayers = $('#current_infos').serializeArray();
        }
        if(template == 2){
            teamgames = $('#current_infos').serializeArray();
            $('#next-step').remove();
        }
        template = template + 1;
        getTemplate(template);
        console.log('clicked');
    });

});
