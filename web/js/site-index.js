$(document).ready(function() {

    // Проверяем есть ли тариф в заказе
    /*
    if (typeof (getUrlVars()["order"]) != "undefined" && getUrlVars()["order"] !== null && getUrlVars()["order"] == "refuse")
    {
        alert("Тариф уже есть в заказе");
        window.history.replaceState({}, document.title, "/site/index" );
    }
    */

    // Обработка клика на иконку заказа тарифа
    $('.u-svg-link').on('click', function (event) {
        event.preventDefault();

        // Если пользователь неавторизовн, просим авторизваться
        // Иначе показываем модальное окно
        if (is_guest == "guest"){
            $(this).attr("data-toggle", "none"); // Предотвращаем появление модального окна
            alert("Для заказа тарифа авторизуйтесь");
        } else {
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
        }
    })
})

// Считывает GET переменные из URL страницы и возвращает их как ассоциативный массив.
/*
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
*/