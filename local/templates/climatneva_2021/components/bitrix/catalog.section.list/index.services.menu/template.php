<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["SECTIONS"])) return;

?><div class="container">
    <h2><?=GetMessage("SERVICES_SECTION_TITLE");?></h2>
    <ul class="services__wrapper index_tiles_grid"><?
    foreach ($arResult["SECTIONS"] as $section) {
        ?><li>
            <div class="index_tiles_bg bg-image" style="background-image:url('<?=$section["ICON"];?>');"></div>
            <a href="<?=$section["SECTION_PAGE_URL"];?>"><?=$section["NAME"];?></a>
        </li><?
    }
    ?></ul>
</div>