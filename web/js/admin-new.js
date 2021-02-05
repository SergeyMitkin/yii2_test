// Обработка клика на иконку принятия заказа
$(document).ready(function() {

    // Показываем модальное окно
    $('#confirm-order-modal').on('show.bs.modal', function (event) {
        var icon = $(event.relatedTarget);
        var order_id = icon.data('order-id');
        var url = icon.data('url');
        var modal = $(this);

        modal.find('.modal-body').html('<h3 align="center">Подтвердить заказ </h3><h3 align="center">№ ' + order_id + '? </h3>' +
            '<div align="center" class="div-confirm-buttons">' +
                '<a href="' + url + '" class="confirm-buttons btn btn-success" id="confirm-order-a_' + order_id  + '">Подтвердить</a>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
            '</div>');

        // При клике на ссылку "Подтвердить", подтверждаем заказ и перезагружаем GridView
        $('#confirm-order-a_' + order_id).on('click', function (event) {
            event.preventDefault();

            modal.modal('hide');

            $.pjax.reload({
                container:'#admin-new-orders',
                data: {id: order_id}
            });
        })
    })
})
