<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["ITEMS"])) return;

?><div class="top-block">
    <div class="container">
        <ul class="top-block__wrapper"><?
        foreach ($arResult["ITEMS"] as $item) {
          $pic = $item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"];
            ?><li>
                <div class="top-block__img"><img src="<?=$pic["SRC"];?>" width="<?=$pic["WIDTH"];?>" height="<?=$pic["HEIGHT"];?>" alt="<?=$item["NAME"];?>" class="img-contain"></div>
                <div class="top-block__text"><?=$item["NAME"];?></div>
            </li><?
        }
        ?></ul>
    </div>
</div><?
