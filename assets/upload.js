jQuery(document).ready(function($){

    function upload_file() {
        var file = new FormData();
        file.append( "main_image", $('#main_image')[0].files[0]);
        file.append( "action", 'upload_file');  
        file.append( "post", 'user');    

        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: file,
            processData: false,
            contentType: false,
        }).done(function(response) {
            $('#myForm').html(response);
        });
    };

    $('#upload').click(function(){
        upload_file();
    });
});
