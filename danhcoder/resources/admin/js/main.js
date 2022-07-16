$(document).ready(function () {
    /* setup btn-delete */
    $('.btn-delete a').click(function (e) {
        e.preventDefault();
        confirm('Bạn có muốn xoá không!')
    });

    /* Auto Remove Note */
    var myVar = setInterval(removeNoteText, 5000);
    function removeNoteText() {
        $('.note-form').text('');
    }
    /* STAR DROP MENU */
    $('.item-nav').click(function () {
        $(this).find('.sub-menu:first').slideToggle();

        var dropsub = $(this).find('.drop-icon:first').attr('class');
        if (dropsub.includes('rotate')) {
            $(this).find('.drop-icon:first').removeClass('rotate')
        } else {
            $(this).find('.drop-icon:first').addClass('rotate');
        }
    });
    /* END DROP MENU */

    /* STAR ON OFF SIDEBAR */
    $('.sidebar-icon').click(function (e) {
        e.preventDefault();
        $('.sidebar').toggle(300);

        var attrWrapper = $('.wrapper').attr('class');

        if (attrWrapper.includes('m-0')) {
            $('.wrapper').removeClass('m-0');
        } else {
            $('.wrapper').addClass('m-0');
        }

        var attrHeader = $('.header').attr('class');

        if (attrHeader.includes('header-pl')) {
            $('.header').removeClass('header-pl');
        } else {
            $('.header').addClass('header-pl');
        }

        var attrSidebarIcon = $('.sidebar-icon').attr('class');
        if (attrSidebarIcon.includes('rota-hori')) {
            $('.sidebar-icon').removeClass('rota-hori');
        } else {
            $('.sidebar-icon').addClass('rota-hori');
        }
    });
    /* END ON OFF SIDEBAR */

    /* STAR CUSTOM USSER MENU*/
    $('.thumb-user').click(function (e) {
        e.preventDefault();
        $(this).find('.custom-user').slideToggle(300);
    });
    /* END CUSTOM USER MENU */


    /* LOAD MORE */
    $('.item-more').slice(0, 5).show();
    if ($('.item-more:hidden').length * 1 == 0) {
        $('.btn-more').slideUp(300);
    }
    $('.btn-more').click(function (e) {
        e.preventDefault();
        $('.item-more:hidden').slice(0, 10).slideDown();
        if ($('.item-more:hidden').length * 1 > 0) {
            $('.btn-more').slideDown(300);
        } else {
            $('.btn-more').slideUp(300);
        }
    })

    $('.item-more-thumb').slice(0, 5).show();
    if ($('.item-more-thumb:hidden').length * 1 == 0) {
        $('.btn-more-thumb').slideUp(300);
    }
    $('.btn-more-thumb').click(function (e) {
        e.preventDefault();
        $('.item-more-thumb:hidden').slice(0, 10).slideDown();
        if ($('.item-more-thumb:hidden').length * 1 > 0) {
            $('.btn-more-thumb').slideDown(300);
        } else {
            $('.btn-more-thumb').slideUp(300);
        }
    })
    /* END LOAD MORE */

    /* COPY TEXT
        + Create a <textarea> and set its content to the text you want to copy to the clipboard.
        + Append textarea to DOM.
        + Select text in text area using
        + Call document.execCommand("copy") to copy the content from the textarea to the clipboard
        + Remove the text area from the document. show copied message
    */

    $('.copy-content').click(function (e) {
        e.preventDefault();
        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
            alert('Đã Copy URL: ' + text)
        }
        var copyText = $(this).attr('data-url');;
        copyToClipboard(copyText);
    });

    /* AND COPY TEXT */


    /* UPLOAD BOX */
    $('.up-load-img').click(function (e) {
        e.preventDefault();
        $('.box-upload').slideToggle();
    });
    /* END UPLOAD BOX */

    /* 
    **
        ------ RADIO GALLERY AVATAR  ADD PRODUCT PAGE
    **
    */

    /* show box Gallery */
    $('.btn-gallery-avatar').click(function (e) {
        e.preventDefault();
        $('.gallery-add-avatar').show();
    });
    /* Hidden box Gallery */
    $('.off-gallery').click(function (e) {
        e.preventDefault();
        $('.gallery-add-avatar').hide();
    });
    /* 
        ------ inseet avatar in gallery
    */
    $('.add-avatar-radio').click(function (e) {
        e.preventDefault();

        /* 
        ------ Get value input radio gallery 
        ------ Show box avatar get in Gallery
        ------ Set value input gallery import saver
        ------ Hidden Gallery
        */
        var selectRadio = $('[name="radio-avatar"]:radio:checked');
        if (selectRadio.length > 0) {
            var checkedRadioAvatar = selectRadio.val();
            $('.box-avatar').show();
            $('.box-edit-file-avatar').show();
            $('.img-avatar').attr('src', checkedRadioAvatar);
            $('.input-gallery').attr('value', checkedRadioAvatar);
        }

        $('.gallery-add-avatar').hide();
        $('.box-edit').hide();
    });

    $('.btn-avatar-edit').click(function (e) {
        e.preventDefault();
        $('.gallery-add-avatar').show();
    });

    /* 
    **
        ----- END RADIO GALLERY AVATAR  
    **
    */


    /* 
    ****
        ---- CHECK GALLERY THUMB ADD PRODUCT PAGE
    *****
    */
    /* Show Gallery */
    $('.btn-gallery-thumb').click(function (e) {
        e.preventDefault();
        $('.gallery-add-thumb').show();

    });
    /* Hidden Gallery */
    $('.off-gallery-thumb').click(function (e) {
        e.preventDefault();
        $('.gallery-add-thumb').hide();
    });
    /*  */
    $('.btn-edit-gallery-thumb').click(function (e) {
        e.preventDefault();
        $('.gallery-add-thumb').show();
    });
    $('.btn-edit-thumb-page-edit').click(function (e) {
        e.preventDefault();

        $('.btn-gallery-thumb').show();
        $(this).hide();
    });
    /* Get Value Input Gallery and Show Images in box-thumb  check-thumb*/
    $('.add-thumb-check').click(function (e) {
        e.preventDefault();
        var valCheck = [];
        $('[name="check-thumb[]"]:checkbox:checked').each(function (i) {
            valCheck[i] = $(this).val();
        });

        if (valCheck.length === 0) {
            $(".info-gallery").remove();

            $('.btn-gallery-thumb').show();
            $('.btn-edit-gallery-thumb').hide();
        } else {
            $(".box-thumb").show();
            $(".info-gallery").remove();
            /* render Html Image Thumb */
            valCheck.forEach(valCheckItem => {
                var thumbHtml =
                    ' <div class="thumb-img box-add-thumb info-gallery">'
                    + '<img src="' + valCheckItem + '">'
                    + '<div class="btn-positon">'
                    + '<input type="hidden" type="checkbox" name="inputThumbGallery[]" value = "' + valCheckItem + '">'
                    + '</div></div >';
                var htmlThumb = $.parseHTML(thumbHtml);
                $('.box-thumb').append(htmlThumb);
            });
            $('.box-edit-file-thumb').show();

        }
        /* hiden Gallery add thum box */
        $('.box-add-gallery-thumb').hide();
        $('.gallery-add-thumb').hide();
    });
    /* END CHECK GALLERY THUMB  */

    /* 
        ------ delete avatar in gallery
    */
    $('.delete-avatar-gallery').click(function (e) {
        e.preventDefault();
        $('.box-edit').show();

        /* ------ Hidden and reset value input radio gallery */
        $('.box-avatar').toggle();
        $('.input-gallery').attr('vale', "");


        $('[name="radio-avatar"]:radio:checked').each(function () {
            $(this).prop('checked', false);
        });
        /* ------ Show box upload file avatar And Hidden box-avartar */
        $('.box-avatar').hide();

        /* ------Reset value input gallery and img avatar */
        $('.input-gallery').attr('value', '');
        $('.img-avatar').attr('src', '');


        /* Page edit pruduct show box-edit avatar */
        $('box-edit-file-avatar').show();
        $('.btn-gallery-avatar').show();
    });


    /* 
    **
        ------ DELETE IMAGE THUMB
    **
    */
    $("label.delete-mtimg").click(function () {
        $(this).parent(".box-thub-delete").css("display", "none");
    });

    /* 
    **
        ------ BOX UPDATE CAT
    **
    */
    $('.btn-on-edit-cat').click(function (e) {
        e.preventDefault();
        $('.cat-update').show();
        $('.btn-off-edit-cat').show();
        $(this).hide();
        $('.cat-current').hide();
    });
    $('.btn-off-edit-cat').click(function (e) {
        e.preventDefault();
        $('.cat-update').hide();
        $('.btn-on-edit-cat').show();
        $(this).hide();
        $('.cat-current').show();
    });




});
