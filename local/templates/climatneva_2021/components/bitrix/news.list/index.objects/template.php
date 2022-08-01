<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["ITEMS"])) return;

?><div class="container">
    <div class="objects__carousel owl-carousel"><?
        foreach ($arResult["ITEMS"] as $item) {
            $strTag = '';
            if (!empty($item["PROPERTIES"]["TAGS"]["VALUE"]) && sizeof($item["PROPERTIES"]["TAGS"]["VALUE"])) {
                foreach ($item["PROPERTIES"]["TAGS"]["VALUE"] as $tag) {
                    $strTag .= '<div class="objects__tag">'.$tag.'</div>';
                }
            }
        ?><div class="objects-slider__item">
            <div class="item__inner-box">
                <div class="item__right-box">
                    <div style="background-image:url('<?=$item["THUMB"];?>');"></div>
                </div>
                <div class="item__left-box">
                    <div class="item__left-text-box"><?
                        if ($strTag !== '') {
                        ?><div class="objects__tags-box__before"><?=$strTag;?></div><?
                        }
                        ?><h2><?=$item["NAME"];?></h2><?
                        if ($strTag !== '') {
                        ?><div class="objects__tags-box"><?=$strTag;?></div><?
                        }
                        ?><div class="objects__text"><?=$item["PREVIEW_TEXT"];?></div><?
                        if (!empty($item["PROPERTIES"]["INSTALLED_EQ"]["VALUE"]) && sizeof($item["PROPERTIES"]["INSTALLED_EQ"]["VALUE"])) {
                        ?><div class="objects__equip-title"><?=GetMessage('OBJECTS_EQUIP_TITLE');?></div>
                        <ul class="objects__equip"><?
                        foreach ($item["PROPERTIES"]["INSTALLED_EQ"]["VALUE"] as $eqID) {
                            if (empty($arResult["EQUIP"][$eqID])) continue;
                            $equipment = $arResult["EQUIP"][$eqID];
                            ?><li><a href="<?=$equipment["DETAIL_PAGE_URL"];?>" target="_new"><?=$equipment["NAME"];?></a></li><?
                        }
                        ?></ul><?
                        }
                    ?></div>
                </div>
            </div>
        </div><?
        }
    ?></div>
</div>