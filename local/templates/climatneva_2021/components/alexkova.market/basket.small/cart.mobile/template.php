<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult["BASKET_ITEMS"]["CAN_BUY"]) && $arResult["BASKET_ITEMS"]["CAN_BUY"] > 0) {
    ?><div class="box__value cart__value"><?=sizeof($arResult["BASKET_ITEMS"]["CAN_BUY"]);?></div><?
}