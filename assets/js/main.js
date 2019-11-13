$(document).ready(function(){
    $('form').validate({
        rules: {
            // link: {
            //     url: false,
            //     required: false
            // }
        },
        messages: {
            // link: {
                // url: "Введите валидный Url"
                // required: "Введите не пустую строку"
            // }
        },
        submitHandler: function(){
            sendLink();
        }
    });

    function sendLink(){
        var link = $('#link').val();
        $.ajax({
            url: '',
            data: {link: link},
            type: 'POST',
            success: function(res){
                console.log(res);
            },
            error: function(){
                console.log('Error!');
            }
        });
    }

});