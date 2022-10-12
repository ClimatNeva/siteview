<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["ITEMS"])) return;

?><div class="certs__wrapper">
    <div class="certs__inner">
        <div class="certs__carousel owl-carousel"><?
        foreach ($arResult["ITEMS"] as $item) {
            if (empty($item["PREVIEW_PICTURE"])) continue;
            ?><div class="certs__item"><?
            htmlTools::drawPictureTagWithWebp(
              [0 => $item["PREVIEW_PICTURE"]],
              [
                "itemName" => $section["NAME"],
                "widthSets" => [0 => ["width" => 330, "height" => 464]],
                "webp" => 50,
                "lazyload" => "class=\"owl-lazy\" data-",
              ]
            );
            /* ?><img src="<?=$item["THUMB"];?>" alt="<?=$item["NAME"];?>" class="img-contain"><? */
            ?></div><?
        }
        ?></div>
    </div>
</div>
