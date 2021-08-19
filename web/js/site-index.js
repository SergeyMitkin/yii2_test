$(document).ready(function() {

    // Обработка клика на иконку заказа тарифа
    $('.u-svg-link').on('click', function (event) {
        var icon = $(event.currentTarget);
        var rate_id = icon.attr('data-rate-id');
        var rate_name = icon.attr('data-rate-name');
        var price = icon.attr('data-price');
        var url = icon.data('data-url');

        // Если пользователь неавторизован, просим авторизваться
        // Иначе просим подтвердить заказ тарифа
        if (is_guest == "guest"){

            $(this).attr("data-toggle", "none"); // Предотвращаем появление модального окна
            alert("Для заказа тарифа авторизуйтесь");

        } else {

            var question = 'Заказать' + rate_name + ' за ' + price + ' $?';
            const result = confirm(question);

            if (result === true){
                var action = "adOrder";

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        ajax: action,
                        rate_id: rate_id,
                        rate_name: rate_name
                    },
                    error: function () {
                        alert('Что-то пошло не так!');
                    },
                    success: function (res) {
                        var obj = jQuery.parseJSON(res);
                        var order = obj['order'];
                        
                        if (order === 'created'){
                            alert(obj['rate_name'] + ' добавлен в заказ')
                        }
                    }
                })
            }
        }
    })
})