<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$str2Script = '';
?>

<div class="recomendations">
    <div class="row">
        <?foreach($arResult["ITEMS"] as $arItem):
            $str2Script .= '$("#single_image_'.$arItem["ID"].'").fancybox();';
            //$str2Script .= '$.fancybox.open($("#single_image_'.$arItem["ID"].'"));';
        ?>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <a href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="rec-link" id="single_image_<?=$arItem["ID"]?>">
                <img src="<?=$arItem["PREVIEW_PICTURE_SMALL"]["SRC"]?>" class="img-responsive">
            </a>
            <div class="rec-text"><?=$arItem["NAME"]?></div>
        </div>
        <?endforeach;?>
    </div>
</div>

<div class="recomend-to-hide" data-functionname="setFancy_p<?=$arResult["NAV_RESULT"]->NavPageNomer?>">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<?if ($arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->NavPageCount):?>
<div class="row">
    <div class="col-xs-12">
        <button class="bxr-btn-invert get-recomend" data-iblock="recomend">Смотреть еще</button>
    </div>
</div>
<?endif;?>
<script>
function setFancy_p<?=$arResult["NAV_RESULT"]->NavPageNomer?>(){
    <?=$str2Script?>
}
</script>
