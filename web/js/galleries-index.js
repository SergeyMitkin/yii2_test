$(document).ready(function() {

    // Редактирование галереи
    $(".edit-gallery-span").on('click', function () {
        var gallery_id =$(this).attr('id').split("_").pop();

        $.ajax({
            url: '',
            type: "GET",
            data: {
                ajax: 'get-gallery-data',
                gallery_id: gallery_id
            },
            error: function(){
                alert('Что-то пошло не так!');
            },
            success: function(response) {
                var obj = jQuery.parseJSON(response); // Объект с данными галереи
                $("#gallery-modal-name-input").val(obj.name);
                $("#gallery-modal-description-textarea").val(obj.description);
                $("#create-gallery-form-id").append("<input type='text' name='gallery_id' value='" + obj.id + "' hidden>"); // В скрытый инпут помещаем id галереи
            }
        })
    })

    //console.log('pjax');

    // Удаление галереи
    $('#delete-gallery-modal').on('show.bs.modal', function (event) {
        var gallery_id = $(event.relatedTarget).data("gallery-id");
        var url = $(event.relatedTarget).data("url");

        $(this).find('.modal-body').html('<h3 align="center">Удалить галерею?</h3>' +
            '<div align="center" class="div-confirm-buttons">' +
                '<a href="' + url + '" class="confirm-buttons confirm-delete btn btn-success" data-id="' + gallery_id + '">Удалить</a>' +
                '<button class="confirm-buttons btn btn-danger" data-dismiss="modal">Отмена</button>' +
            '</div>');

        // При клике на ссылку "Удалить", удаляем галерею
        $('.confirm-delete').on('click', function (event) {
            event.preventDefault();
            var id = $(this).data("id");
            var modal = $("#delete-gallery-modal");

            modal.modal('hide');

            $.pjax.reload({
                container:"#galleries-listView",
                data: {
                    action: "delete-gallery",
                    id: id
                }
            });
        })
    })
})