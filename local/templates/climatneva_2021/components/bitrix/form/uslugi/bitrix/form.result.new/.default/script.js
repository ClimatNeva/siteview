

$(document).ready(function(){
    $('#form_text_15').val(pageName);
    
    $('.uslugi-order-f').submit(function(e){
        e.preventDefault();
        let options = $(this).serializeArray();
        console.log(options);
        if (options[2].value.length < 2) {
            showNotFilledModalWindow('form_text_13','Поле необходимо заполнить');
            return;
        }
        if (options[3].value.length<7 || !validatePhone(options[3].value)) {
            showNotFilledModalWindow('form_text_14','Поле необходимо заполнить');
            return;
        }
        options.push({name: 'ajax', value: 'Y'});
        $.ajax('/ajax/callback-request.php', {data: options})
            .always(function (data) {
                if (data === 'ADDED') {
                    showAddedItem();
                    setTimeout(function() {
                        $('.uslugi-order-f').trigger('reset');
                        $('.modal_submit').detach();
                    }, 1500);
                } else {
                    console.log(data);
                }
            });
    })
    
    $('.eqipment-btn').click(function(event){
        event.preventDefault();
        $("html, body").animate({
             scrollTop: $('#equipment-callback').offset().top - 100 + "px"
        }, {
             duration: 500,
             easing: "swing"
        });
    });
});

function showAddedItem() {
    let innerDiv = `<div class="modal_submit">Ваша заявка принята. С вами свяжется менеджер</div>`;
    $('.callback-box').append(innerDiv);
}
