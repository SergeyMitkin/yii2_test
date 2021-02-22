$(document).ready(function() {

    $(".edit-gallery-span").on('click', function () {
        var gallery_id =$(this).attr('id').split("_").pop();

        $.ajax({
            url: '',
            type: "GET",
            data: {
                ajax: 'get_gallery_data',
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
})