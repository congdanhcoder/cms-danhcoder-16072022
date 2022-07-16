$(document).ready(function (e) {
    /* 
    ============== UPLOAD FILE IMAGE GALLERY
    */
    $('.formUploadAjax').submit(function (e) {
        e.preventDefault();
        $('.loading').show();
        var $form = $(this);
        url = $form.attr('action');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                $('.loading').hide();
                $('.box-gallery').html(data.outputPa);
                $('.box-gallery-add-avatar').html(data.outputAv);
                $('.box-gallery-add-thumb').html(data.outputThumb);
                $('.note-form').text(data.note);
                $('.box-more-img-ajax').css('display', data.btnMore);

                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });

    });

    /* 
    ============== DELETE FILE IMAGES GALLERY
    */
    $('.btn-delete-image').on('click', function () {
        var linkImage = $(this).attr('data-url');
        var idImage = $(this).attr("id-image");
        if (confirm('Bạn có chắc chắn muốn xoá!')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                data: { idImage: idImage, linkImage: linkImage },
                url: 'delete-ajax-gallery',
                success: (data) => {
                    $('.box-gallery').html(data.outputPa);
                    $('.box-gallery-add-avatar').html(data.outputAv);
                    $('.box-gallery-add-thumb').html(data.outputThumb);
                    $('.note-form').text(data.note);
                    $('.box-more-img-ajax').css('display', data.btnMore);
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });

        } else {
            return false;
        }
    });

    /* 
    ============== LOAD MORE IMAGE GALLERY
    */
    $('.btn-more-img-ajax').click(function (e) {
        e.preventDefault();
        $('.loading').show();
        var numberLoad = $(this).attr("number-data");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            data: { numberLoad: numberLoad },
            url: "load-ajax-gallery",
            success: (data) => {
                $('.box-gallery').append(data.outputPa);
                $('.box-gallery-add-avatar').append(data.outputAv);
                $('.box-gallery-add-thumb').append(data.outputThumb);
                $('.btn-more-img-ajax').attr("number-data", data.numberOutput);
                $('.box-more-img-ajax').css('display', data.btnMore);
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('#inputSeachPost').keyup(function (e) {
        e.preventDefault();

        var url = $(this).attr('data-url');
        var valueSeach = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            data: { valueSeach: valueSeach },
            url: url,
            success: (data) => {
                $('.contentListPost').html(data.outputPa);
                $('.link-out-seach').html(data.outSeach);
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });

        $value = $(this).val();
        console.log($value);
    });


    $('#inputSeachPrpduct').keyup(function (e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        var valueSeach = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            data: { valueSeach: valueSeach },
            url: url,
            success: (data) => {
                $('.contentListProduct').html(data.outputPa);
                $('.link-out-seach').html(data.outSeach);
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });

        $value = $(this).val();
        console.log($value);
    });
});
