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

?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<div id="bx_3218110189_1668" class="t_1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="bxr-classic-image-v2" data-uid="1" data-resize="1">
        <div class="bxr-section-container">
            <div class="bxr-element-image">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <?if (is_array($arItem["PREVIEW_PICTURE_SMALL"])):?>
                    <img src="<?=$arItem["PREVIEW_PICTURE_SMALL"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                    <?endif;?>
                </a>
            </div>
            <div class="bxr-element-content">
                <div class="bxr-element-name">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                </div>
                <div class="bxr-element-description">
                    <?=$arItem["PREVIEW_TEXT"]?>
                </div>
                <div class="bxr-element-action">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="bxr-border-color-button">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
