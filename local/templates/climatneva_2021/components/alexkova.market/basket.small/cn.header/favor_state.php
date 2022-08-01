<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?><img src="/img/svg/icon_heart.svg" alt="" class="img-inline"><?
if (count($arResult["FAVOR_ITEMS"]) > 0) {
	?><div class="box__value favor__value"><?=count($arResult["FAVOR_ITEMS"]);?></div><?
}
?><?=GetMessage("FAVOR_TITLE")?>