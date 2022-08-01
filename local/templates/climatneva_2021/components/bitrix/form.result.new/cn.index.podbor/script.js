if (typeof newMask === 'undefined') {
    var newMask;
}

domReadyQueue.push(function(){
    $('#AGREEMENT').change(function(){
        if ($(this).prop('checked')) {
            $('form .btn-submit').prop('disabled',false);
        } else {
            $('form .btn-submit').prop('disabled','disabled');
        }
    })
    let imaskInputId = $('input[data-type="phone"]').prop('id');
    $('#' + imaskInputId).focus(function(){
        if (typeof newMask == "undefined" || newMask == "undefined") {
            newMask = IMask(document.getElementById(imaskInputId), {mask: '+{7}(000)000-00-00', lazy: false});
        }
    })
    $('#' + imaskInputId).blur(function(){
        if ($(this).val() == "+7(___)___-__-__") {
            $(this).val('');
            newMask.destroy();
            newMask = "undefined";
        }
    })
    $('.btn-triz-submit').click(function(e){
        e.preventDefault();
        const options = {};//$('#SIMPLE_FORM_'+formId).serializeArray();
        const rooms = $('.room-square').length;
        const arMany = [];
        const roomsTitle = 'Комната ';
        for (let i = 0; i < rooms; i += 1) {
            arMany[i] = `${roomsTitle} ${(i + 1)}:\n`;
        }
        for (const key in arFields) {
            if (key === 'properties') continue;
            if (arFields[key][1] === "many") {
                for (let i = 0; i < rooms; i += 1) {
                    const val = arFields[key][3] === "text" ? $(`input[name="${key}_${i}"]`).val() : $(`.input__show[data-id="${key}_${i}"]`).data('value');
                    arMany[i] = `${arMany[i]}${arFields[key][2]}: ${val}\n`;
                }
            } else {
                options[arFields[key][0]] = arFields[key][3] === "text" ? $(`input[name="${key}"]`).val() : $(`.input__show[data-id="${key}"]`).data('value');
            }
        }
        options[arFields['properties'][0]] = arMany.join("\n");
        options['result'] = 'Y';
        options['WEB_FORM_ID'] = $('.webform').data('webform');
        ajaxOptions = {
            url: '/local/ajax/formcommon.php',
            type: 'POST',
            success: function(res) {
                resultEmbed(res);
                //console.log(res);
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR);
                console.log(exception);
            }
        };
        ajaxOptions.data = options;
        $.ajax(ajaxOptions);
    })
    $('body').click(function(e){
        if ($('.input-box-opener .data-head-div').is(e.target)) {
            $(e.target).toggleClass('opened');
        } else if ($('.input-box-opener').hasClass('opened') && !$('.input-box-opener .box-label').is(e.target) && !$('.input-box-opener .hidden-checkbox').is(e.target)) {
            $('.input-box-opener').removeClass('opened');
        }
    })

    $('.dropdown-select').change(function(){
        let parent = '#' + $(this).data('parent');
        $('select' + parent).val($(this).val());
        $('.data-head-div').text($(this).next('label').html());
        $('.input-box').removeClass('opened');
    })

    $('.input-box').click(function(){
        $(this).toggleClass('opened');
    })

    $('.triz__inner').owlCarousel({
        loop: false,
        margin: 0,
        dots: false,
        nav: false,
        items: 1,
        autoplay: false,
        responsive: false,
        onInitialized: function(e) {
            $('.triz__current').text(e.item.index + 1);
            const newBG = $(`.triz__inner .owl-item:eq(${e.item.index}) .triz__item`).data('src');
            $('.triz__right-bg, .triz__left').animate({ 'opacity':'0' },150);
            setTimeout(function(){
                $('.triz__right-bg, .triz__left').css('background-image',`url(${newBG})`);
                $('.triz__right-bg, .triz__left').animate({'opacity':'1'},150);
            }, 150);
        },
        onChanged: function(e) {
            $('.triz__current').text(e.item.index + 1);
            const newBG = $(`.triz__inner .owl-item:eq(${e.item.index}) .triz__item`).data('src');
            $('.triz__right-bg, .triz__left').animate({ 'opacity':'0' },150);
            setTimeout(function(){
                $('.triz__right-bg, .triz__left').css('background-image',`url(${newBG})`);
                $('.triz__right-bg, .triz__left').animate({'opacity':'1'},150);
            }, 150);
        }
    });

    $('.btn-addroom').click(function(e){
        e.preventDefault();
        const newRoomID = $('.triz__inner .owl-item').length - 2;
        const owlHeight = $('.triz__inner').height();
        const roomTpl = $('.triz__inner .owl-item:eq(0)').html().replaceAll(/_0("|_)/g,'_' + newRoomID + '$1');
        $('.triz__inner').owlCarousel('add', roomTpl, newRoomID);
        $(`.triz__inner .owl-item:eq(${newRoomID}) .triz__room-counter`).text(newRoomID + 1);
        $('.triz__inner').height(owlHeight);
        $('.triz__inner').trigger('to.owl.carousel', newRoomID);
        $('.triz__overall').html($('.triz__inner .owl-item').length);
    });

    $(document).on('click', function(e) {
        if ($('.btn-nextslide').is(e.target)) {
            e.preventDefault();
            $('.triz__inner').trigger('next.owl.carousel');
        }
    })

    $(document).on('click',function(e){
        if ($('.input__show').is(e.target)) {
            if ($('.input__downlist.opened').length) $('.input__downlist.opened').removeClass('opened');
            $('.input__downlist.' + $(e.target).data('list')).toggleClass('opened');
        } else if ($('.radio-input').is(e.target)) {
            let parent = $(e.target).parents('.input__downlist')[0];
            let text = $(document.getElementById($(e.target).prop('for'))).data('text');
            $($(parent).children('.input__show')[0]).text(text);
            let value = $(document.getElementById($(e.target).prop('for'))).val();
            $($(parent).children('.input__show')[0]).data('value',value);
            $(parent).toggleClass('opened');
        } else if ($('.input__downlist.opened').length) {
            $('.input__downlist.opened').removeClass('opened');
        }
    })

})

function resultEmbed(res) {
    let msg = 'Ваша заявка принята.<br>Менеджер свяжется с вами в ближайшее время.';
    if (res != 'LUCKY') {
        msg = 'При отправке заявки произошла ошибка. Попробуйте отправить заявку позже.';
    }
    $('body').addClass('fixed').append(`<div class="webform-answer"><div class="webform-answer__box"><div class="webform-answer__inner"><div class="webform-answer-close"></div>${msg}</div></div></div>`);
    $('.webform-answer').animate({'opacity':'1'},300);
    $('.webform-answer-close').click(function(){
        closeResultEmnedAnswer(res);
    })
    setTimeout(function(){
        closeResultEmnedAnswer(res);
    },4000);
}

function closeResultEmnedAnswer(res) {
    $('.webform-answer').animate({'opacity':'0'},300);
    setTimeout(function(){
        $('.webform-answer').detach();
        $('body').removeClass('fixed');
    },300);
    if (res == 'LUCKY') {
        $('#SIMPLE_FORM_' + $('.webform').data('webform')).trigger('reset');
        $('.input__show').text('').data('value','');
        if ($('.triz__item').length > 3) {
            for (let i = 0; i < $('.triz__item').length - 3; i += 1) {
                $('.triz__inner').owlCarousel('remove', 1);
            }
            $('.triz__overall').html($('.triz__inner .owl-item').length);
            $('.triz__inner').trigger('to.owl.carousel', [0, 300]);
        }
    };
}
