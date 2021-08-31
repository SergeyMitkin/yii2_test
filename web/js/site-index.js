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

            // Показываем модальное окно
            $('#rate-order-modal').on('show.bs.modal', function (event) {

                var icon = $(event.relatedTarget);
                var rate_id = icon.data('rate-id');
                var url = icon.data('url');
                var modal = $(this);

                var question = to_order + rate_name + ' ' + for_ + ' ' + price + ' $?';

                modal.find('.modal-body').html(
                    '<h4 align="center">' + question +'</h4>' +
                    '<div align="center" class="div-confirm-buttons">' +
                    '<button class="confirm-buttons new-btn btn-success" data-dismiss="modal" id="confirm-orders">Ok</button>' +
                    '<button class="confirm-buttons new-btn btn-danger" data-dismiss="modal">Отмена</button>' +
                    '</div>');


            })

            /*
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
            */

        }
    })
})