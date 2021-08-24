// Обработка клика на иконку принятия заказа
$(document).ready(function() {

    // Показываем модальное окно
    $('#action-order-modal').on('show.bs.modal', function (event) {
        var icon = $(event.relatedTarget);
        var order_id = icon.data('order-id');
        var url = icon.data('url');
        var action = icon.data('action');
        var modal = $(this);

        if (action === 'confirm'){
            modal.find('.modal-body').html('<h3 align="center">Подтвердить заказ </h3><h3 align="center">№ ' + order_id + '? </h3>' +
                '<div align="center" class="div-confirm-buttons">' +
                    '<a href="' + url + '" class="confirm-buttons btn btn-success" id="confirm-order-a_' + order_id  + '">Ок</a>' +
                    '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
                '</div>');

            // При клике на ссылку "Ок", подтверждаем заказ
            $('#confirm-order-a_' + order_id).on('click', function (event) {
                modal.modal('hide');

                $.ajax({
                    container:'#admin-new-orders',
                    data: {
                        id: order_id,
                        action: 'confirm'
                    }
                }).done(function () {
                    var new_url = $(location).attr('href').replace(/id=.*?&/, '').replace(/confirm=.*?&/, '');
                    location.href = new_url;
                })
            })
        }

        else if (action === 'cancel'){

            modal.find('.modal-body').html('<h3 align="center">Отменить заказ </h3><h3 align="center">№ ' + order_id + '? </h3>' +
                '<div align="center" class="div-confirm-buttons">' +
                    '<a href="' + url + '" class="confirm-buttons btn btn-success" id="confirm-order-a_' + order_id  + '">Ок</a>' +
                    '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
                '</div>');

            // При клике на ссылку "Ок", подтверждаем заказ
            $('#confirm-order-a_' + order_id).on('click', function (event) {
                modal.modal('hide');

                $.ajax({
                    container:'#admin-new-orders',
                    data: {
                        id: order_id,
                        action: 'cancel'
                    }
                }).done(function () {
                    var new_url = $(location).attr('href').replace(/id=.*?&/, '').replace(/cancel=.*?&/, '');
                    location.href = new_url;
                })

            })
        }
    })
})
