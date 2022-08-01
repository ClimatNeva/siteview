<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult as $item) {
    ?><li><a href="<?=$item["LINK"];?>"><?=$item["TEXT"];?></a></li><?
}