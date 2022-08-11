$(document).ready(function() {

    $("#test-captcha-button").on("click", function (){
        console.log('test');
    });

    $("#form-captcha").on("submit", function (e){
        e.preventDefault();

        grecaptcha.ready(function() {
            grecaptcha.execute(site_key,
                {
                    action: 'homepage'
                }).then(function(token)
            {
                document.getElementById('g-recaptcha-response').value=token;
                $.ajax({
                    type: 'POST',
                    url: '/site/test',
                    data: {
                        recaptcha: token
                    },
                    error: function () {
                        alert('Что-то пошло не так!');
                    },
                    success: function (response) {
                        //var obj = jQuery.parseJSON(response); // Данные задачи
                        console.log(response);

                        if (response == 'success'){
                            $("#test-captcha-button").hide();
                        } else {
                            $("#test-captcha-red-button").hide();
                        }
                    }
                });
            });
        });
    });

    $("#form-captcha").submit();
})