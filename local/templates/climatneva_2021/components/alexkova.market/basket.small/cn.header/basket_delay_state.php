<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$basket_delay_cnt = count($arResult["BASKET_ITEMS"]["CAN_BUY"]) + count($arResult["BASKET_ITEMS"]["DELAY"]);

?><img src="/img/svg/icon_cart.svg" alt="" class="img-inline"><div class="box__value cart__value"><?=$basket_delay_cnt;?></div><?=GetMessage("BASKET_TITLE_COMMON")?><?