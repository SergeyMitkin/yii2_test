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
            alert(log_in_to_order);

        } else {

            var question = to_order + rate_name + ' ' + for_ + ' ' + price + ' $?';
            const result = confirm(question);

            if (result === true){

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        rate_id: rate_id,
                        rate_name: rate_name
                    },
                    error: function () {
                        alert(error_alert);
                    },
                    success: function (res) {
                        var obj = jQuery.parseJSON(res);
                        var order = obj['order'];
                        
                        if (order === 'created'){
                            alert(obj['rate_name'] + ' ' + added_to_order)
                        }
                    }
                })
            }
        }
    })
})