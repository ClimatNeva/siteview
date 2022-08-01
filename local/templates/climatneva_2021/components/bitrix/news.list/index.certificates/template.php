<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["ITEMS"])) return;

?><div class="certs__wrapper">
    <div class="certs__inner">
        <div class="certs__carousel owl-carousel"><?
        foreach ($arResult["ITEMS"] as $item) {
            if (empty($item["THUMB"])) continue;
            ?><div class="certs__item"><img src="<?=$item["THUMB"];?>" alt="<?=$item["NAME"];?>" class="img-contain"></div><?
        }
        ?></div>
    </div>
</div>
