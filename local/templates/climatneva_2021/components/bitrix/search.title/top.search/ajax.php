<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->RestartBuffer();
if(!empty($arResult["CATEGORIES"])){
    ?><div class="title-search-result">
        <div class="title-search__inner"><?
        foreach($arResult["CATEGORIES"] as $category_id => $arCategory){
            foreach($arCategory["ITEMS"] as $i => $arItem){
                ?><a href="<?echo $arItem["URL"]?>" class="item clearfix"><?
                    ?><div class="title-search__title"><?=$arItem["NAME"]?></div><?
                ?></a><?
            }
        }
        ?></div><?
    ?></div><?
    ?><div class="title-search-fader"></div><?
}