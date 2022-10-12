<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["rows"])) return;

?><div class="brands__carousel owl-carousel"><?
foreach ($arResult["rows"] as $item) {
    if (empty($item["IMAGE"])) continue;
    ?><a href="<?=$item["UF_LINK"];?>" class="brands__item"><?
      /* ?><img src="<?=$item["IMAGE"];?>" alt="<?=$item["NAME"];?>" class="img-contain"><? */
      htmlTools::drawPictureTagWithWebp(
        [["SRC" => $item["IMAGE_SRC"]]],
        [
          "itemName" => $item["NAME"],
          "widthSets" => [["width" => 200, "height" => 100]],
          "lazyload" => "class=\"owl-lazy\" data-",
          "create_destination" => true,
          "webp" => 50,
        ]);
    ?></a><?
}
?></div><?