<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?><div class="mobile_heart"><?
if (!empty($arResult["FAVOR_ITEMS"]) && sizeof($arResult["FAVOR_ITEMS"]) > 0) {
    ?><div class="box__value favor__value"><?=sizeof($arResult["FAVOR_ITEMS"]);?></div><?
}
?><?=GetMessage("FAVOR_TITLE");?></div>