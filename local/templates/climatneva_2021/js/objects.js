let currentObjectLink = '/reference/include_objects.php';
let setFilter = false;

$(document).ready(function(){
    let modal_window = `<div class="modal fade" id="objectsModalWindow">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>`;
    $('body').prepend(modal_window);
    
    getNextPage('objects');
    getNextPage('recomend');
    
    $('.review_read_more').click(function(event){
        event.preventDefault();
        $('.modal-content').removeClass('rev-slider');
        $('.appended-review').detach();
        $('.appended-getprice').detach();
        let currentSlide = $(this).data('slidenum');
        let currentHTML = `<div class="appended-review">
        <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="/images/close.svg" width=20 height=20>
                </button>` + $('.rev-slider-inner[data-slidenum="'+currentSlide+'"]').html() + '</div></div>';
        $('.modal-content').append(currentHTML);
        $('.modal-content').addClass('rev-slider');
        $('#objectsModalWindow').modal('show');
        $('.close').click(function(){
            $('#objectsModalWindow').modal('hide');
            $('.modal-content').removeClass('rev-slider');
            $('.appended-review').detach();
        });
    })
});

function getNextPage(iblockType,nextPageLink,deleteHTML) {
    //console.log(currentObjectLink);
    deleteHTML = deleteHTML || false;
    nextPageLink = nextPageLink || '/reference/include_' + iblockType + '.php';
    if (iblockType === 'objects') nextPageLink = currentObjectLink;
    if (!setFilter && $('.' + iblockType + '-to-hide').find('.navigation > .navigation-pages').length>0) {
        let allPageLinks = $('.' + iblockType + '-to-hide').find('.navigation > .navigation-pages').children($('a'));
        nextPageLink = $(allPageLinks[allPageLinks.length-1]).attr('href').replace('//','/');
    }
    $('.' + iblockType + '-to-hide').detach();
    $.ajax(nextPageLink)
        .always(function(data){
            if (deleteHTML)
                $('.ajax-objects-div').html('');
            $('.get-' + iblockType).detach();
            $('.ajax-' + iblockType + '-div').append(data);
            if (iblockType == 'objects') {
                setGetPriceListener();
                $('.tags-checkbox-label').click(function(event){
                    setFilter = true;
                    let outStr = '';
                    let thisID = '';
                    if (!$('.tags-checkbox[id="' + $(this).attr('for') + '"]').prop("checked")) {
                        outStr = outStr + '&' + $(this).attr('for') + '=Y';
                    } else {
                        thisID = $(this).attr('for');
                    }
                    $('.filter_tags input:checkbox:checked').each(function(){
                        //console.log($(this).attr('id') + ' :: ' + thisID);
                        if ($(this).attr('id') != thisID)
                            outStr = outStr + '&' + $(this).attr('id') + '=Y';
                    })
                    currentObjectLink = '/reference/include_objects.php?set_filter=true' + outStr;
                    //console.log(newLink);
                    //setTimeout(function() {
                        getNextPage('objects',currentObjectLink,true);
                    //}, 2000);
                })
            }
            window[$('.' + iblockType + '-to-hide').data('functionname')]();
            let allPageLinks = $('.' + iblockType + '-to-hide').find('.navigation > .navigation-pages').children();
            if ($(allPageLinks[allPageLinks.length-1]).attr('href') != undefined) {
                $('.get-' + iblockType).click(function(event){
                    event.preventDefault();
                    getNextPage($(this).data('iblock'));
                });
            } else {
                $('.get-' + iblockType).detach();
            }
            setFilter = false;
        });
    return;
}

function setGetPriceListener() {
    $('.bxr-getprice').off('click');
    $('.bxr-getprice').click(function(event){
        event.preventDefault();
        $('.modal-content').removeClass('rev-slider');
        $('.appended-review').detach();
        $('.appended-getprice').detach();
        let currentID = $(this).data('objectid');
        let currentContent = `<div class="appended-getprice">
        <div class="modal-header">
                <div class="modal-title">Запрос цены</div>
                <div class="modal-close-btn"></div>
            </div>
            <form class="object-request" name="object_request" action="/" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-box" id="OBJECT-NAME">
                        <label for="firstname" class="filters__label">Имя<span class="starrequired">*</span></label>
                        <input type="text" class="modal-input" name="NAME" id="firstname">
                    </div>
                    <div class="input-box" id="OBJECT-EMAIL">
                        <label for="address" class="filters__label">E-mail<span class="starrequired">*</span></label>
                        <input type="text" class="modal-input" name="EMAIL" id="email">
                    </div>
                    <div class="input-box" id="OBJECT-PHONE">
                        <label for="phone" class="filters__label">Телефон<span class="starrequired">*</span></label>
                        <input type="text" class="modal-input" name="PHONE" id="phone">
                    </div>
                    <div class="input-box" id="OBJECT-AGREEMENT">
                        <label for="agreement" class="accept_form">
                            <input type="checkbox" name="AGREEMENT" id="agreement" value="yes">
                            Согласен на обработку данных в соответствии с положением
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="color-button bxr-color bxr-color-button bxr-bg-hover-light" type="submit" name="object-submit" value="Отправить запрос">
                </div>
                </form>
        </div>`;
        $('.modal-content').append(currentContent);
        $('#objectsModalWindow').modal('show');

        $('.modal-close-btn').click(function(){
            $('#objectsModalWindow').modal('hide');
            $('.appended-getprice').detach();
        })
    
        $('.object-request').submit(function(event){
            event.preventDefault();
            let options = $(this).serializeArray();
            if (options[0].value.length < 1) {
                showNotFilledModalWindow('OBJECT-NAME','Поле необходимо заполнить');
                return;
            }
            if (!validateEmail(options[1].value)) {
                showNotFilledModalWindow('OBJECT-EMAIL','Поле необходимо заполнить правильно');
                return;
            }
            if (options[2].value.length<7/* || !validatePhone(options[1].value)*/) {
                showNotFilledModalWindow('OBJECT-PHONE','Поле необходимо заполнить');
                return;
            }
            if (!$('#agreement').prop('checked')) {
                showNotFilledModalWindow('OBJECT-AGREEMENT','Обработка заявки без вашего согласия невозможна');
                return;
            }
            options.push({name: 'ajax', value: 'Y'});
            options.push({name: 'obj-id', value: $('.bxr-getprice').data('objectid')});
            $.ajax('/ajax/objectprice-request.php', {data: options})
                .always(function (data) {
                    if (data === 'ADDED') {
                        showAddedItem();
                        setTimeout(function() {
                            $('#objectsModalWindow').modal('hide');
                            $('.object-request').trigger('reset');
                            $('.appended-getprice').detach();
                        }, 1500);
                    } else {
                        console.log(data);
                    }
                });
        })
    });
}

function validateEmail(email) {
    let pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(String(email).toLowerCase());
}

function validatePhone(phone) {
    if (phone.length > 19) return false;
    let pattern = /^[\+\(\)\-0-9 ]+$/;
    return pattern.test(phone);
}

function showNotFilledModalWindow(fieldName, alertString) {
    let modalAgree = '';
    if (fieldName == 'OBJECT-AGREEMENT') modalAgree = ' agreement';
    let modalAlertWin = `<div class="modal_alert${modalAgree}">${alertString} :: ${fieldName}</div>`;
    $('div[id=' + fieldName + ']').append(modalAlertWin);
    setTimeout(function(){
        $('.modal_alert').detach();
    }, 1500);
}

function showAddedItem() {
    let innerDiv = `<div class="modal_submit">Ваша заявка принята.<br>С вами свяжется менеджер</div>`;
    $('.modal-body').append(innerDiv);
}
