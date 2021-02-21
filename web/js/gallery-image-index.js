$(document).ready(function() {

    function getGalleryData(gallery_id){

    }
    //console.log('gallery-image');
    $(".edit-gallery-span").on('click', function (event) {

        var gallery_id =$(this).attr('id').split("_").pop(); // Получаем id галереи из id кнопки
        console.log(gallery_id);

    })

    $("#create-gallery-modal").on('show.bs.modal', function () {

        //console.log($(this));

        /*
        modal.find(".modal-body").html(
            '<form class="create-gallery-form" id="create-gallery-form-id">' +

                '<div class="group" id="group-for-gallery-name-input">' +
                    '<label for="gallery-modal-name-input">Название галереи</label>' +
                    '<span id="input-for-gallery-name">' +
                        '<input type="text" id="gallery-modal-name-input" name="gallery_name" placeholder="Название галереи">' +
                    '</span>' +
                '</div>' +

                '<div class="group" id="group-for-gallery-description-input">' +
                    '<label for="gallery-modal-description-input">Описание галереи</label>' +
                    '<span id="input-for-gallery-description">' +
                        '<input type="text" id="gallery-modal-description-input" name="gallery_description" placeholder="Описание галереи">' +
                    '</span>' +
                '</div>' +

                '<div class="group" align="center">' +
                     '<button id="gallery-create-post-button" class="btn btn-success">Отправить</button>' +
                '</div>' +

            '</form>'
        )
        */
        //console.log(modal);
    })

})