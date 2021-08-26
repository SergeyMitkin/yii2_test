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
                })
            })
        }
    })

    // Убираем гет-параметры после принятия или отмены заказа
    var href_without_id_parametr = removeURLParameter($(location).attr('href'), 'id');
    var href_without_id_and_action_parameters = removeURLParameter(href_without_id_parametr, 'action');
    window.history.pushState({}, '', href_without_id_and_action_parameters);

        // При скрытии модального окна, очищмем гет-параметры
    /*
    $('#action-order-modal').on('hidden.bs.modal', function (event) {
        var href_without_id_parametr = removeURLParameter($(location).attr('href'), 'id');
        var href_without_id_and_action_parameters = removeURLParameter(href_without_id_parametr, 'action');
        window.history.pushState({}, '', href_without_id_and_action_parameters);
    })
    */

    // Отменить выбранные заказы
    $("#delete-select").on("click", function(e){
        e.preventDefault()
        var keys = $("#grid").yiiGridView("getSelectedRows");
        $.ajax({
            url: "'. \yii\helpers\Url::toRoute('delete') .'",
            type: "POST",
            data: {id: keys},
            success: function(){
                alert("yes")
            }
        })
    });


    // Функция для удаления гет-параметров
    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts= url.split('?');
        if (urlparts.length>=2) {

            var prefix= encodeURIComponent(parameter)+'=';
            var pars= urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i= pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            if(pars.length > 0) {
                url= urlparts[0]+'?'+pars.join('&');
            } else {
                url= urlparts[0];
            }

            return url;
        } else {
            return url;
        }
    }
})
