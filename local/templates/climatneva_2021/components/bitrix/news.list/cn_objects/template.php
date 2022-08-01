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
//echo "<pre>",print_r($arResult["FILTER_CHECKED_TAGS"]),"</pre>";
?>

<?if ($arResult["NAV_RESULT"]->NavPageNomer < 2):?>
<div class="row">
    <div class="col-xs-12">
        <form action="/" class="filter_tags" name="object_request" method="POST" enctype="multipart/form-data">
            <?foreach ($arResult["FILTER_PROPERTY_TAGS"] as $propID=>$propText):?>
            <input type="checkbox" class="tags-checkbox" id="tag[<?=$propID?>]" <?
                if (isset($arResult["FILTER_CHECKED_TAGS"][$propID]))
                echo $arResult["FILTER_CHECKED_TAGS"][$propID]
                   ?>>
            <label for="tag[<?=$propID?>]" class="tags-checkbox-label"><?=$propText?></label>
            <?endforeach;?>
        </form>
    </div>
</div>
<?endif;?>

<?
if (sizeof($arResult["ITEMS"])>0):
$str2script = '';
foreach($arResult["ITEMS"] as $arItem):
?>
<div class="object-box">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
          <section class="slider">
                <?$arSliderContent = '<li><img src="'.$arItem["PREVIEW_PICTURE_SMALL"]["SRC"].'" class="img-responsive"></li>';
                foreach ($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO_SMALL"]["VALUE"] as $pic) {
                    $arSliderContent .= '<li><img src="'.$pic["SRC"].'" width="'.$pic["WIDTH"].'" height="'.$pic["HEIGHT"].'"></li>';
                }?>
                <div id="slider_<?=$arItem["ID"]?>" class="flexslider slider_big">
                    <ul class="slides">
                        <?=$arSliderContent?>
                    </ul>
                </div>
                <div id="carousel_<?=$arItem["ID"]?>" class="flexslider slider_small">
                    <ul class="slides slides-bordered">
                        <?=$arSliderContent?>
                    </ul>
                </div>
            </section>
        </div>
        <div class="col-xs-12 col-sm-6">
            <h3><?=$arItem["NAME"]?></h3>
            <p><?echo TruncateText($arItem["PREVIEW_TEXT"],$arParams);?></p>
            <h4>Установленное оборудование</h4>
            <ul class="equip">
               <?foreach ($arItem["DISPLAY_PROPERTIES"]["INSTALLED_EQ"]["LINK_ELEMENT_VALUE"] as $eqItem) {
                    echo '<li><a href="'.$eqItem["DETAIL_PAGE_URL"].'">'.$eqItem["NAME"].'</a></li>';
                }?>
            </ul>
            <button class="bxr-color-button bxr-getprice" data-objectid="<?=$arItem["ID"]?>">Узнать цену</button>
        </div>
    </div>
</div>
<?$str2script .= "
      $('#carousel_".$arItem["ID"]."').flexslider({
        animation: 'slide',
        controlNav: true,
        animationLoop: false,
        slideshow: false,
        itemWidth: 68,
        itemMargin: 27,
        asNavFor: '#slider_".$arItem["ID"]."'
      });

      $('#slider_".$arItem["ID"]."').flexslider({
        animation: 'slide',
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        sync: '#carousel_".$arItem["ID"]."',
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    ";?>
<?endforeach;?>
<div class="objects-to-hide" data-functionname="setSlider_p<?=$arResult["NAV_RESULT"]->NavPageNomer?>" data-allpages="<?=$arResult["NAV_RESULT"]->NavPageCount?>">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<?if ($arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->NavPageCount):?>
<div class="row">
    <div class="col-xs-12">
        <button class="bxr-btn-invert get-objects" data-iblock="objects">Смотреть еще</button>
    </div>
</div>
<?endif;?>
<script>
function setSlider_p<?=$arResult["NAV_RESULT"]->NavPageNomer?>(){
    <?=$str2script?>
}
</script>
<?else:?>
    <p>Объектов с заданными параметрами не найдено.</p>
<?endif;?>
    