// Обработка клика на иконку принятия заказа
$(document).ready(function() {

    // При закрытии модального окна, восстанавливаем css иконки, по клику на которую, его открыли
    $('#action-order-modal').on('hidden.bs.modal', function () {

        $(".pressed-icon").css('color', 'rgb(60,141,188)').mouseover(function() {
            $(this).css("color","rgb(114,175,210)");
        }).mouseout(function() {
            $(this).css("color","rgb(60,141,188)");
        }).removeClass("pressed-icon");
    })

    // Показываем модальное окно
    $('#action-order-modal').on('show.bs.modal', function (event) {

        var icon = $(event.relatedTarget);
        icon.addClass("pressed-icon"); // Добавляем класс к иконке, по которой кликнули для вызова окна, чтобы при закрытии окна, вернуть ей первоначальный цвет
        var order_id = icon.data('order-id');
        var url = icon.data('url');
        var action = icon.data('action');
        var modal = $(this);

        // Подтверждаем выбранные заказы
        if (action === 'confirm-select') {

            modal.find('.modal-body').html(
                '<h3 align="center">Подтвердить выбранные заказы? </h3>' +
                '<div align="center" class="div-confirm-buttons">' +
                '<button class="confirm-buttons btn btn-success" data-dismiss="modal" id="confirm-orders">Ok</button>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
                '</div>');

            $("#confirm-orders").on("click", function (event) {

                var keys = $("#w0").yiiGridView("getSelectedRows"); // Выбранные заказы

                // Если есть отмеченные заказы, отпарвляем ajax-запрос и перезагружаем pjax
                if (keys.length !== 0){
                    $.ajax({
                        type: "GET",
                        data: ({
                            id: keys,
                            action: 'confirm'
                        }),
                        error: function(){
                            alert('Что-то пошло не так!');
                        },
                        success: function(){
                            // Обновляем pjax
                            $.pjax.reload('#admin-new-orders', {url: $(location).attr('href')});
                        }
                    })
                } else {
                    alert("Отметьте заказы, которые хотите принять");
                }

            })
        }

        // Подтверждаем отдельный заказ
        else if (action === 'confirm'){

            modal.find('.modal-body').html('<h3 align="center">Подтвердить заказ </h3><h3 align="center">№ ' + order_id + '? </h3>' +
                '<div align="center" class="div-confirm-buttons">' +
                '<button class="confirm-buttons btn btn-success" data-dismiss="modal" id="confirm-order-button_' + order_id + '">Ok</button>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
                '</div>');

            // При клике на ссылку "Ок", подтверждаем заказ
            $('#confirm-order-button_' + order_id).on('click', function (event) {

                var keys = [order_id];

                if (keys.length !== 0) {
                    $.ajax({
                        type: "GET",
                        data: ({
                            id: keys,
                            action: 'confirm'
                        }),
                        error: function () {
                            alert('Что-то пошло не так!');
                        },
                        success: function () {
                            // Обновляем pjax
                            $.pjax.reload('#admin-new-orders', {url: $(location).attr('href')});
                        }
                    })
                }

            })

        }

        // Отменяем выбранные заказы
        else if (action === 'cancel-select') {

            modal.find('.modal-body').html(
                '<h3 align="center">Отменить выбранные заказы? </h3>' +
                '<div align="center" class="div-confirm-buttons">' +
                '<button class="confirm-buttons btn btn-success" data-dismiss="modal" id="cancel-orders">Ok</button>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
                '</div>');


            $("#cancel-orders").on("click", function (event) {

                var keys = $("#w0").yiiGridView("getSelectedRows"); // Выбранные заказы

                // Если есть отмеченные заказы, отпарвляем ajax-запрос и перезагружаем pjax
                if (keys.length !== 0){
                    $.ajax({
                        type: "GET",
                        data: ({
                            id: keys,
                            action: 'cancel'
                        }),
                        error: function(){
                            alert('Что-то пошло не так!');
                        },
                        success: function(){
                            // Обновляем pjax
                            $.pjax.reload('#admin-new-orders', {url: $(location).attr('href')});
                        }
                    })
                } else {
                    alert("Отметьте заказы, которые хотите отменить");
                }

            })

        }


    })




        /*
        else if (action === 'cancel') {

            modal.find('.modal-body').html('<h3 align="center">Отменить заказ </h3><h3 align="center">№ ' + order_id + '? </h3>' +
                '<div align="center" class="div-confirm-buttons">' +
                '<a href="' + url + '" class="confirm-buttons btn btn-success" id="confirm-order-a_' + order_id + '">Ок</a>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
                '</div>');

            // При клике на ссылку "Ок", подтверждаем заказ
            $('#confirm-order-a_' + order_id).on('click', function (event) {
                event.preventDefault;
                modal.modal('hide');

                $.ajax({
                    container: '#admin-new-orders',
                    data: {
                        id: order_id,
                        action: 'cancel'
                    }
                })
            })
        }
    })
    */

    // Убираем гет-параметры после принятия или отмены заказа
    /*
    var href_without_id_parametr = removeURLParameter($(location).attr('href'), 'id');
    var href_without_id_and_action_parameters = removeURLParameter(href_without_id_parametr, 'action');
    window.history.pushState({}, '', href_without_id_and_action_parameters);
    */

    // Функция для удаления гет-параметров
    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            if (pars.length > 0) {
                url = urlparts[0] + '?' + pars.join('&');
            } else {
                url = urlparts[0];
            }

            return url;
        } else {
            return url;
        }
    }

})

