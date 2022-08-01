<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// <img src="/img/svg/icon_compare.svg" alt="" class="img-inline">
?><div class="mobile_compare"><?
if (count($arResult) > 0) {
    ?><div class="box__value favor__value"><?=count($arResult);?></div><?
}
?><?=GetMessage("COMPARE_TITLE");?></div>