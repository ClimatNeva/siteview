<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["ITEMS"])) return;

?><div class="slider">
    <div class="container">
        <div class="slider-carousel owl-carousel"><?
        foreach ($arResult["ITEMS"] as $key => $item) {
            $link = !empty($item["PROPERTIES"]["LINK"]["VALUE"]) ? $item["PROPERTIES"]["LINK"]["VALUE"] : false;
            if ($link) {
                ?><a href="<?=$link;?>"<?
            } else {
                ?><div<?
            }
            ?> class="slider__item">
            <picture class="slider__item-picture"><?
                if (!empty($item["DISPLAY_PROPERTIES"]["SMALL_IMAGE"]["FILE_VALUE"]["SRC"])) {
                    ?><source media="(max-width:400px)" srcset="<?=$item["DISPLAY_PROPERTIES"]["SMALL_IMAGE"]["FILE_VALUE"]["SRC"];?>"<?
                        ?> type="<?=$item["DISPLAY_PROPERTIES"]["SMALL_IMAGE"]["FILE_VALUE"]["CONTENT_TYPE"];?>"><?
                }
                if (!empty($item["DISPLAY_PROPERTIES"]["MEDIUM_IMAGE"]["FILE_VALUE"]["SRC"])) {
                    ?><source media="(max-width:991.98px)" srcset="<?=$item["DISPLAY_PROPERTIES"]["MEDIUM_IMAGE"]["FILE_VALUE"]["SRC"];?>"<?
                        ?> type="<?=$item["DISPLAY_PROPERTIES"]["MEDIUM_IMAGE"]["FILE_VALUE"]["CONTENT_TYPE"];?>"><?
                }
                if (!empty($item["PREVIEW_PICTURE"]["SRC"])) {
                    ?><source media="(min-width:992px)" srcset="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"<?
                        ?> type="<?=$item["PREVIEW_PICTURE"]["CONTENT_TYPE"];?>"><?
                    ?><img src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>" alt="<?=$item["NAME"];?>"><?
                }
            ?></picture><?
            if (!empty($item["PROPERTIES"]["SHOW_TITLE"]["VALUE"])) {
                ?><div class="slider__title"><?=$item["NAME"];?></div><?
            }
            if ($link) {
                ?></a><?
            } else {
                ?></div><?
            }
        }
        ?></div>
    </div>
</div><?
