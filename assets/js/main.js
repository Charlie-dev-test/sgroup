$(document).ready(function(){
    // запускаем валидацию формы
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
            // в случае успешной валидации запускаем отправку данных
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

    //функция вывода на экран полученного результата отправки данных
    function setResult(res){
        $('.result').html('<p>'+res+'</p>');
    }

});