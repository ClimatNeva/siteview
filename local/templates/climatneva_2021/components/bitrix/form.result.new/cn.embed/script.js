var newMask;

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
    if ($('input[type="file"]').length) {
        fileInput('fileUpload','fileBtn','fileName',$('input[type="file"]').data('text'));
        $('input[type="file"]').change(function(){
            if ($('.fileName').text() != '') {
                $('.fileUpload').addClass('filled');
                $('.fileBtn').text($('.fileName').text());
            } else {
                $('.fileUpload').removeClass('filled');
            }
        })
    }
    $('.btn-submit').click(function(e){
        e.preventDefault();
        let formId = $('.webform').data('webform');
        let formData = new FormData($('#SIMPLE_FORM_'+formId)[0]);
        let options = $('#SIMPLE_FORM_'+formId).serializeArray();
        if (validateForm(options,'','SIMPLE_FORM_'+formId)) {
            ajaxOptions = {
                url: '/local/ajax/formcommon.php',
                type: 'POST',
                success: function(res) {
                    resultEmbed(res);
                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                }
            };
            if ($('input[type="file"]').length) {
                formData.append('result','Y');
                ajaxOptions.processData = false;
                ajaxOptions.contentType = false;
                ajaxOptions.dataType = 'text';
                ajaxOptions.data = formData;
            } else {
                options.push({name: 'result',value: 'Y'});
                ajaxOptions.data = options;
            }
            $.ajax(ajaxOptions);
        }
    })
    $('body').click(function(e){
        if ($('.input-box-opener .data-head-div').is(e.target)) {
            $(e.target).toggleClass('opened');
        } else if ($('.input-box-opener').hasClass('opened') && !$('.input-box-opener .box-label').is(e.target) && !$('.input-box-opener .hidden-checkbox').is(e.target)) {
            $('.input-box-opener').removeClass('opened');
        }
    })
    $('.multiple-select').change(function(){
        let parent = '#' + $(this).data('parent');
        let currentSelect = $('select' + parent + ' option:selected').size() > 0 ? $('select' + parent).val() : [];
        let indx = currentSelect.indexOf($(this).val());
        if ($(this).prop("checked") && indx == -1) {
            currentSelect[currentSelect.length] = $(this).val();
        } else if (!$(this).prop("checked") && indx != -1) {
            if (currentSelect.length > 1) {
                currentSelect.splice(indx,1);
            } else {
                currentSelect = [];
            }
        }
        $('select' + parent).val(currentSelect);
    })
})
