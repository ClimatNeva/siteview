$(document).ready(function(){
    let modal_window = `
<div class="modal fade" id="gaugerRequestModalBox">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Вызов замерщика</div>
                <div class="modal-close-btn"></div>
            </div>
            <form class="gauger-request" name="gauger_request" action="/" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-box" id="GAUGER-NAME">
                        <label for="firstname" class="filters__label">Имя<span class="starrequired">*</span></label>
                        <input type="text" class="modal-input" name="NAME" id="firstname">
                    </div>
                    <div class="input-box" id="GAUGER-PHONE">
                        <label for="phone" class="filters__label">Телефон<span class="starrequired">*</span></label>
                        <input type="text" class="modal-input" name="PHONE" id="phone">
                    </div>
                    <div class="input-box" id="GAUGER-ADDRESS">
                        <label for="address" class="filters__label">Адрес<span class="starrequired">*</span></label>
                        <input type="text" class="modal-input" name="ADDRESS" id="address">
                    </div>
                    <div class="input-box" id="GAUGER-AGREEMENT">
                        <label for="agreement" class="accept_form">
                            <input type="checkbox" name="AGREEMENT" id="agreement" value="yes">
                            Согласен на обработку данных в соответствии с положением
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="color-button bxr-color bxr-color-button bxr-bg-hover-light" type="submit" name="gauger-submit" value="Отправить запрос">
                </div>
                </form>
        </div>
    </div>
</div>
    `;
    
    $('body').prepend(modal_window);
    
    $(document).on('click','.bxr-gauger-call', function(event) {
        event.preventDefault();
        //ym(31317263, 'reachGoal', 'call_engineer');
		//yaCounter31317263.reachGoal('call_engineer');
        $('#gaugerRequestModalBox').modal('show');
    });

    $('.modal-close-btn').click(function(){
        $('#gaugerRequestModalBox').modal('hide');
    })
    
    $('.gauger-request').submit(function(event){
        event.preventDefault();
        let options = $(this).serializeArray();
        if (options[0].value.length < 2) {
            showNotFilledModalWindow('GAUGER-NAME','Поле необходимо заполнить');
            return;
        }
        if (options[1].value.length<7 || !validatePhone(options[1].value)) {
            showNotFilledModalWindow('GAUGER-PHONE','Поле необходимо заполнить');
            return;
        }
        if (options[2].value.length < 2) {
            showNotFilledModalWindow('GAUGER-ADDRESS','Поле необходимо заполнить');
            return;
        }
        if (!$('#agreement').prop('checked')) {
            showNotFilledModalWindow('GAUGER-AGREEMENT','Обработка заявки без вашего согласия невозможна');
            return;
        }
        options.push({name: 'ajax', value: 'Y'});
        options.push({name: 'eq-id', value: $('.bxr-gauger-call').data('equipmentid')});
        //yaCounter31317263.reachGoal('send_call_engineer');
        $.ajax('/ajax/gauger-request.php', {data: options})
            .always(function (data) {
                if (data === 'ADDED') {
                    showAddedItem();
                    setTimeout(function() {
                        $('#gaugerRequestModalBox').modal('hide');
                        $('.gauger-request').trigger('reset');
                        $('.modal_submit').detach();
                    }, 1500);
                } else {
                    console.log(data);
                }
            });
    })
});

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
    if (fieldName == 'GAUGER-AGREEMENT') modalAgree = ' agreement';
    let modalAlertWin = `<div class="modal_alert${modalAgree}">${alertString}</div>`;
    $('div[id=' + fieldName + ']').append(modalAlertWin);
    setTimeout(function(){
        $('.modal_alert').detach();
    }, 1500);
}

function showAddedItem() {
    let innerDiv = `<div class="modal_submit">Ваша заявка принята.<br>С вами свяжется менеджер</div>`;
    $('.modal-body').append(innerDiv);
}
