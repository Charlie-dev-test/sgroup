$(document).ready(function(){
    $('form').validate({
        rules: {
            link: {
                url: true,
                required: true
            }
        },
        messages: {
            link: {
                url: "Введите валидный Url",
                required: "Введите не пустую строку"
            }
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
                setResult(res);
            },
            error: function(){
                setResult(res);
            }
        });
    }

    function setResult(res){
        $('.result').html('<p>'+res+'</p>');
    }

});