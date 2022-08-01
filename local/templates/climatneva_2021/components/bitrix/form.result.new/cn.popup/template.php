<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?><div class="popup-window-container">
<div class="popup-bg"></div>
<div class="popup-block">
    <div class="popup-close"></div>
    <div class="popup-inner">
		<div class="h3"><?=$arResult["FORM_TITLE"]?></div><?
		if (!empty($arResult["FORM_DESCRIPTION"])) {
			?><div class="popup-description"><?=$arResult["FORM_DESCRIPTION"];?></div><?
		}
		?><form action="" id="popup_form" data-form="<?=$arResult['arForm']['ID'];?>">
			<input type="hidden" name="NAME" value="">
			<input type="hidden" name="sessid" id="sessid" value="<?=bitrix_sessid();?>">
			<input type="hidden" name="recaptcha_response" id="recaptchaResponse_popup_form">
			<?
			foreach ($arResult["arQuestions"] as $FIELD_SID => $arQuestion) {
				$inputID = "form_".$arResult['arAnswers'][$FIELD_SID][0]['FIELD_TYPE']."_".$arQuestion['ID'];
				if ($arQuestion['FIELD_TYPE'] == 'hidden')
				{
					echo $arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"];
				}
				else if ($arQuestion['COMMENTS'] == 'itemid') {
					?><input type="hidden" name="<?=$inputID;?>"><?
					$itemIDField = $inputID;
				}
				else if ($arQuestion['COMMENTS'] == 'itemname') {
					?><input type="hidden" name="<?=$inputID;?>"><?
					$itemNameField = $inputID;
				}
				else
				{
					?><div class="input-box <?=$inputID;?>"><?
					/*?><label for="<?=$inputID;?>" class="inputlabel"><?=$arQuestion['TITLE'];?><?=($arQuestion['REQUIRED'] == 'Y' ? ' <span class="red">*</span>':'');?></label><?*/
						if ($arResult['arAnswers'][$FIELD_SID][0]['FIELD_TYPE'] == "text") {
						?><input type="text" id="<?=$inputID;?>" name="<?=$inputID;?>" class="inputtext"
							<?=(!empty($arQuestion['COMMENTS']) ?' data-type="'.$arQuestion['COMMENTS'].'"':'');?>
							<?=($arQuestion['REQUIRED'] == 'Y' ? ' data-req="Y"':'');?> placeholder="<?=$arQuestion['TITLE'];?>" <?
							if (strpos($arQuestion['TITLE'],"Телефон") !== false) {
								echo " data-type=\"phone\"";
							} else if (strpos($arQuestion['TITLE'],"E-mail") !== false) {
								echo " data-type=\"email\"";
							} else {
								echo " data-type=\"text\"";
							}
							?>><?
						} else if ($arResult['arAnswers'][$FIELD_SID][0]['FIELD_TYPE'] == "textarea") {
							?><textarea name="<?=$inputID;?>" rows="10" id="<?=$inputID;?>" class="inputtextarea"
							<?=(!empty($arQuestion['COMMENTS']) ?' data-type="'.$arQuestion['COMMENTS'].'"':'');?>
							<?=($arQuestion['REQUIRED'] == 'Y' ? ' data-req="Y"':'');?> placeholder="<?=$arQuestion['TITLE'];?>"></textarea><?
						} else {
							echo $arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"];
						}
					?></div><?
				}
			}
			?><div class="popup-btn">
				<div class="btn btn-red btn-submit-<?=$arResult['arForm']['ID'];?>"><span class="btn-inner">Отправить</span></div>
			</div>
		</form>
	</div>
</div>
</div><!-- popup-window-container -->
<link href="/local/ajax/form.css?<?=time();?>" type="text/css"  rel="stylesheet" />
<script>
function setFormHandler() {
	//$.getScript('//www.google.com/recaptcha/api.js?render=<?=RECAPTCHA_SITE_V3_KEY;?>', waitGrecaptcha(onloadCallbackRecap));

	<?if (!empty($itemIDField) && !empty($arParams["ITEMID"])) {
		?>$('input[name="<?=$itemIDField;?>"]').val(<?=$arParams["ITEMID"];?>);<?
	}
	if (!empty($itemNameField) && !empty($arParams["ITEMNAME"])) {
		?>$('input[name="<?=$itemNameField;?>"]').val("<?=$arParams["ITEMNAME"];?>");
		$('.popup-inner .h3').append('<br><span class="item-name"><?=$arParams["ITEMNAME"];?></span>');<?
	}?>
    let imaskInputId = $('#popup_form input[data-type="phone"]').prop('id');
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
    $('.btn-submit-<?=$arResult['arForm']['ID'];?>').click(function(e){
		e.preventDefault();
		let formData;
		if ($('input[type="file"]').length) {
			formData = new FormData($('#popup_form')[0]);
			formData.append('WEB_FORM_ID',$($('#popup_form')[0]).data('form'));
			formData.append('ajax','Y');
		}
		let options = $('form#popup_form').serializeArray();
		options.push({name: 'WEB_FORM_ID', value: <?=$arResult['arForm']['ID'];?>});
		options.push({name: 'ajax', value: 'Y'});
		if (validateForm(options,'','popup_form')) {
			if ($('input[type="file"]').length) {
				$.ajax({
					url: '/local/ajax/formcommon.php',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					dataType: 'text',
					success: function(data) {
						showPopupMessage(data);
					},
					error: function(jqXHR, exception) {
						console.log(jqXHR);
						console.log(exception);
					}
				});
			} else {
				$.ajax({
					url: '/local/ajax/formcommon.php',
					type: 'POST',
					data: options,
					success: function(data) {
						showPopupMessage(data);
					},
					error: function(jqXHR, exception) {
						console.log(jqXHR);
						console.log(exception);
					}
				});
			}
		}
	})
}

var greCaptchaCounter = 0;

function waitGrecaptcha(func) {
    if (typeof grecaptcha != 'undefined') {
        func();
    } else {
        if (greCaptchaCounter++ > 10) return;
        setTimeout(function(){
            waitGrecaptcha(func);
        }, 500);
    }
}
	
var onloadCallbackRecap = function() {
	grecaptcha.ready(function () {
		grecaptcha.execute("<?=RECAPTCHA_SITE_V3_KEY;?>", { action: "popup_form" })
		.then(function (token) {
			var recaptchaResponse = document.getElementById("recaptchaResponse_popup_form");
			recaptchaResponse.value = token;
		});
	});
};
</script>
