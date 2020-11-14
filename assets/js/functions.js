function show(divId) {
    $("#" + divId).show();
}
function hide(divId) {
    $("#" + divId).hide();
}

function dropdown() {
    if ($("#experience").css("display") == "none") {
        show('experience');
    } else {
        hide('experience');
    }
};

jQuery(document).ready(function($){
    $('.team_sidebar').each(function(){
        var imgContainer = $(this).find('.icon-picture');
        var teamnamepopup = imgContainer.closest(".team_sidebar");
        var popup = teamnamepopup.find('.team_sidebar_name');

        $(this).mouseover(function(){
            if (popup) {
                popup.css('left', '100px');
                popup.css('opacity', '1');
            };
        });

        $(this).mouseleave(function(){
            if(popup) {
                popup.css('left', '0px');
                popup.css('opacity', '0');
            }
        });
    });

    $('#menu_dropdown').click(function(){
        var dropdown = $('.ul-child');
        var dropdownButton = $('#menu_dropdown');
        if(dropdown.css('height') == '0px') {
            dropdown.css('height', '200px');
            dropdown.css('opacity', '1');
            dropdownButton.css('transform', 'rotate(180deg)');
        } else {
            dropdown.css('height', '0px');
            dropdown.css('opacity', '0');
            dropdownButton.css('transform', 'rotate(0deg)');
        }
    });

    // function firstVisitHelp() {
    //     var button = '<a id="confirm_button_swalhref="/modifier-le-profil">Modifier mon profil</a>';
    //     console.log('sweetalert test');
    //     Swal.fire({
    //         icon: 'success',
    //         title: 'Bienvenue sur Woncup.fr',
    //         text: 'Complétez maintenant votre profil !',
    //         timer: 3000,
    //         timerProgressBar: true,    
    //         confirmButtonText: button,
    //     });
    // };
    
    // firstVisitHelp();

    // Boutons Register
    var state = 'unchecked';
    $('.remember-button-replace').click(function(){
        $('#remember').click();
        if(state == 'unchecked'){
            $(this).css('background-color', '#3491ca');
            state = 'checked';
        } else {
            $(this).css('background-color', '#292d39');
            state = 'unchecked';
        };
    })
});