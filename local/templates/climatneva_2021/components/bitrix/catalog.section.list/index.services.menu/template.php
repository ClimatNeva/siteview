<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["SECTIONS"])) return;

?><div class="container">
    <h2><?=GetMessage("SERVICES_SECTION_TITLE");?></h2>
    <ul class="services__wrapper index_tiles_grid"><?
    foreach ($arResult["SECTIONS"] as $section) {
        ?><li><?
        /*  style="background-image:url('<?=$section["ICON"];?>');" */
            ?><div class="index_tiles_bg bg-image"><?
            $arSize = (intval($section["UF_SORT"]) === 2) ? [0 => ["width" => 730, "height" => 480]] : [0 => ["width" => 375, "height" => 292]];
            htmlTools::drawPictureTagWithWebp(
              [0 => $section["ICON"]],
              [
                "itemName" => $section["NAME"],
                "widthSets" => $arSize,
                "webp" => 50,
                "crop" => true,
              ]
            );
            ?></div>
            <a href="<?=$section["SECTION_PAGE_URL"];?>"><?=$section["NAME"];?></a>
        </li><?
    }
    ?></ul>
</div>