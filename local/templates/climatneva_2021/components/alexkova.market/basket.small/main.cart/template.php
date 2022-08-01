<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?><li><a href="<?=$arParams["PATH_TO_FAVOR"];?>" class="box__wrapper"><img src="/img/svg/icon_heart.svg" alt="" class="img-inline"><?
if (!empty($arResult["FAVOR_ITEMS"]) && sizeof($arResult["FAVOR_ITEMS"]) > 0) {
    ?><div class="box__value favor__value"><?=sizeof($arResult["FAVOR_ITEMS"]);?></div><?
}
?><?=GetMessage("FAVOR_TITLE");?></a></li><?

?><li><a href="<?=$arParams["PATH_TO_COMPARE"];?>" class="box__wrapper"><img src="/img/svg/icon_compare.svg" alt="" class="img-inline"><?
if (!empty($arResult["BASKET_ITEMS"]["CAN_BUY"]) && $arResult["BASKET_ITEMS"]["CAN_BUY"] > 0) {
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.compare.list",
        "compare.compact",
        Array(
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "12",
            "POSITION_FIXED" => "Y",
            "POSITION" => "top left",
            "DETAIL_URL" => "",
            "COMPARE_URL" => "compare.php",
            "NAME" => "CATALOG_COMPARE_LIST",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id"
        ),
        $component
    );
}
?><?=GetMessage("COMPARE_TITLE");?></a></li><?

?><li><a href="<?=$arParams["PATH_TO_BASKET"];?>" class="box__wrapper"><img src="/img/svg/icon_cart.svg" alt="" class="img-inline"><?
if (!empty($arResult["BASKET_ITEMS"]["CAN_BUY"]) && $arResult["BASKET_ITEMS"]["CAN_BUY"] > 0) {
    ?><div class="box__value cart__value"><?=sizeof($arResult["BASKET_ITEMS"]["CAN_BUY"]);?></div><?
}
?><?=GetMessage("BASKET_TITLE");?></a></li><?
