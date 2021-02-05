// Обработка клика на иконку заказа тарифа
$(document).ready(function() {

    $('.rate-order-buttons').on('click', function (event) {
        event.preventDefault();
    })

    // Показываем модальное окно
    $('#rate-order-modal').on('show.bs.modal', function (event) {
        var icon = $(event.relatedTarget);
        var rate_id = icon.data('rate-id');
        var price = icon.data('price');
        var url = icon.data('url');
        var modal = $(this);

        modal.find('.modal-body').html('<h3 align="center">Заказать Тариф ' + rate_id + ' за ' + price + ' $? </h3>' +
            '<div align="center" class="div-confirm-buttons">' +
                '<a href="' + url + '" class="confirm-buttons btn btn-success" id="rate-order-a_' + rate_id + '">Подтвердить</a>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
            '</div>');
    })
})