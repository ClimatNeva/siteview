<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["SECTIONS"])) return;

?><div class="container">
    <h2><?=GetMessage("SOLUTIONS_SECTION_TITLE");?></h2>
    <ul class="decision__menu"><?
    foreach ($arResult["SECTIONS"] as $key => $section) {
        ?><li class="linked-hover" data-decision="<?=$key;?>">
            <a href="<?=$section["SECTION_PAGE_URL"];?>"><?=$section["NAME"];?></a>
        </li><?
    }
    ?></ul>
    <ul class="decision__media index_tiles_grid"><?
    foreach ($arResult["SECTIONS"] as $key => $section) {
        ?><li class="linked-hover" data-decision="<?=$key;?>">
            <div class="index_tiles_bg bg-image" style="background-image:url('<?=$section["ICON"];?>');"></div>
            <a href="<?=$section["SECTION_PAGE_URL"];?>"><?=$section["NAME"];?></a>
        </li><?
    }
    ?></ul>
</div>