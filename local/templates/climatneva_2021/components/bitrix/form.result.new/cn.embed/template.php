<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>",print_r($arResult),"</pre>";

if ($arResult["isFormErrors"] == "Y"):
	?><div class="form-errors"><?=$arResult["FORM_ERRORS_TEXT"];?></div><?
endif;	
?><div class="web-form-<?=$arResult["arForm"]["ID"];?>-box webform" data-webform="<?=$arResult["arForm"]["ID"];?>"><?
    if (empty($arParams["SHOW_TITLE"]) || $arParams["SHOW_TITLE"] != "N") {
    ?><div class="form-title-box">
        <h2 class="form-header"><?=$arResult["FORM_TITLE"]?></h2><?
        if (!empty($arResult["FORM_DESCRIPTION"])) {
            ?><p><?=$arResult["FORM_DESCRIPTION"]?></p><?
        }
    ?></div><?
    }
    ?><?=strtr($arResult["FORM_HEADER"],["<form" => "<form id=\"".$arResult["WEB_FORM_NAME"]."\""])?>
    <input type="hidden" name="NAME"><?
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
    {
        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
        {
            echo $arQuestion["HTML_CODE"];
        }
        else
        {
            $class = ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "multiselect" ? " input-box-opener" : "");
        ?><div class="input-box<?=$class;?> form_<?=$arQuestion["STRUCTURE"][0]["FIELD_TYPE"];?>_<?=$arQuestion["STRUCTURE"][0]["ID"];?>"><?
            echo $arQuestion["HTML_CODE"];
        ?></div><?
        }
    } //endwhile
    if (!empty($arParams["SHOW_AGREEMENT"]) && $arParams["SHOW_AGREEMENT"] == "Y") {
    ?><div class="input-box AGREEMENT">
        <input type="checkbox" class="inputcheck" name="AGREEMENT" id="AGREEMENT" value="Y" checked>
        <label for="AGREEMENT" class="inputlabel"><?=GetMessage('WEB_FORM_AGREEMENT_LABEL');?></label>
    </div><?
    }
    ?><div class="web-form__btn-row"><div class="btn btn-red btn-submit"><span class="btn-inner"><?=$arResult["arForm"]["BUTTON"];?></span></div></div>
    <?=$arResult["FORM_FOOTER"]?>
</div>