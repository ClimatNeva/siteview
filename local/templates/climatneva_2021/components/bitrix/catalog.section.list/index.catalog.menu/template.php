<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["SECTIONS"])) return;
// save2log($arResult["SECTIONS"]);
?><div class="container">
    <h2><?=GetMessage("CATALOG_SECTION_TITLE");?></h2>
    <ul class="catalog__wrapper"><?
    foreach ($arResult["SECTIONS"] as $section) {
        ?><li><a href="<?=$section["SECTION_PAGE_URL"];?>">
            <div class="catalog__img"><?
              htmlTools::drawPictureTagWithWebp(
                [0 => $section["ICON"]],
                [
                  "itemName" => $section["NAME"],
                  "widthSets" => [0 => ["width" => 85, "height" => 85]],
                  "webp" => 50,
                ]
              );
              /* ?><img src="<?=$section["ICON"];?>" alt="<?=$section["NAME"];?>" class="img-contain"><? */
            ?></div>
            <div class="catalog__title"><?=$section["NAME"];?></div></a>
        </li><?
    }
    ?></ul>
</div>