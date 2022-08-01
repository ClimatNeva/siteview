<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<form action="" class="uslugi-order-f">
    <input type="hidden" name="ajax">
    <input type="hidden" name="WEB_FORM_ID" value="<?=$arResult["arForm"]["ID"];?>">
<div class="row callback-form">
    <div class="col-xs-12 col-sm-4" id="form_text_13">
        <input type="text" class="inputtext" name="form_text_13" value="" size="0" placeholder="Ваше имя">
    </div>
    <div class="col-xs-12 col-sm-4" id="form_text_14">
        <input type="text" class="inputtext" name="form_text_14" value="" size="0" placeholder="Телефон">
    </div>
    <div class="col-xs-12 col-sm-4">
        <button class="bxr-color-button bxr-callback" type="submit">Заказать звонок</button>
    </div>
    <input type="hidden" name="form_text_15" id="form_text_15">
</div>
</form>
