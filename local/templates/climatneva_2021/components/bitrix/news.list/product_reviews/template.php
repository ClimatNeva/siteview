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

//echo "<pre>",print_r($arResult),"</pre>";
//echo "<pre>",print_r($arParams),"</pre>";
if ($arResult["NAV_RESULT"]->NavRecordCount > 0):
?>
<?$this->SetViewTarget('productReviewCounter');?>
 <span class="pr-counter"><?=$arResult["NAV_RESULT"]->NavRecordCount;?></span>
<?$this->EndViewTarget();?>         
<?endif;?>
<div class="product-reviews">
    <div class="product-reviews-add">
        <div class="pr-add-btn-place">
            <button class="bxr-color-button bxr-button-left-product-review" data-itemid="<?=$arParams["ELEMENT_ID"]?>">Оставить отзыв</button>
        </div>
        <div class="pr-add-form-place"></div>
    </div>
    <div class="pr-body">
<?
foreach ($arResult['ITEMS'] as $key=>$arItem) {
    if ($arResult["NAV_RESULT"]->NavRecordCount>2 && $arResult["NAV_RESULT"]->NavRecordCount==$arResult["NAV_RESULT"]->NavPageSize && $arResult["NAV_RESULT"]->NavPageCount==1 && $key<intval($arParams["NEWS_COUNT"])) continue;
    $randID = randString(10);
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="pr-author">
                    <span class="pr-author-head"><?=$arItem["PROPERTIES"]["REV_AUTHOR"]["VALUE"]?></span>
                    <span class="pr-explain"><?=$arItem["PROPERTIES"]["REV_DATE"]?></span>
                </div>
                <div class="pr-stars">
                    <div class="bx_stars_container" style="width: <?=intval($arItem["PROPERTIES"]["REV_RATING"]["VALUE_SORT"])*15;?>px;">
                        <div class="bx_stars_bg"></div>
                        <div class="bx_stars_progres"></div>
                    </div>
                    <div class="pr-explain"><?=$arItem["PROPERTIES"]["REV_RATING"]["VALUE"]?></div>
                </div>
                <?if (mb_strlen($arItem["PROPERTIES"]["REV_VALUES"]["VALUE"]) > 0):?>
                <div class="pr-text">
                    <div class="pr-text-head">Достоинства</div>
                    <div class="pr-text-plain"><?
                    if (mb_strlen($arItem["PROPERTIES"]["REV_VALUES"]["VALUE"]) > 325) {
                        $search2space = mb_strpos($arItem["PROPERTIES"]["REV_VALUES"]["VALUE"], ' ', 300);
                        echo mb_substr($arItem["PROPERTIES"]["REV_VALUES"]["VALUE"],0,$search2space)
                            ,'<span class="show-text" data-stid="values_'.$randID.'"></span>'
                            ,'<span class="hidden-text" data-stid="values_'.$randID.'">'
                            ,mb_substr($arItem["PROPERTIES"]["REV_VALUES"]["VALUE"],$search2space)
                            ,'</span>';
                    } else {
                        echo $arItem["PROPERTIES"]["REV_VALUES"]["VALUE"];
                    }
                    ?></div>
                </div>
                <?endif;?>
                <?if (mb_strlen($arItem["PROPERTIES"]["REV_DOWNSIDES"]["VALUE"]) > 0):?>
                <div class="pr-text">
                    <div class="pr-text-head">Недостатки</div>
                    <div class="pr-text-plain"><?
                    if (mb_strlen($arItem["PROPERTIES"]["REV_DOWNSIDES"]["VALUE"]) > 325) {
                        $search2space = mb_strpos($arItem["PROPERTIES"]["REV_DOWNSIDES"]["VALUE"], ' ', 300);
                        echo mb_substr($arItem["PROPERTIES"]["REV_DOWNSIDES"]["VALUE"],0,$search2space)
                            ,'<span class="show-text" data-stid="downsides_'.$randID.'"></span>'
                            ,'<span class="hidden-text" data-stid="downsides_'.$randID.'">'
                            ,mb_substr($arItem["PROPERTIES"]["REV_DOWNSIDES"]["VALUE"],$search2space)
                            ,'</span>';
                    } else {
                        echo $arItem["PROPERTIES"]["REV_DOWNSIDES"]["VALUE"];
                    }
                    ?></div>
                </div>
                <?endif;?>
                <?if (mb_strlen($arItem["PROPERTIES"]["REV_COMMENT"]["VALUE"]) > 0):?>
                <div class="pr-text">
                    <div class="pr-text-head">Комментарий</div>
                    <div class="pr-text-plain"><?
                    if (mb_strlen($arItem["PROPERTIES"]["REV_COMMENT"]["VALUE"]) > 325) {
                        $search2space = mb_strpos($arItem["PROPERTIES"]["REV_COMMENT"]["VALUE"], ' ', 300);
                        echo mb_substr($arItem["PROPERTIES"]["REV_COMMENT"]["VALUE"],0,$search2space)
                            ,'<span class="show-text" data-stid="comment_'.$randID.'"></span>'
                            ,'<span class="hidden-text" data-stid="comment_'.$randID.'">'
                            ,mb_substr($arItem["PROPERTIES"]["REV_COMMENT"]["VALUE"],$search2space)
                            ,'</span>';
                    } else {
                        echo $arItem["PROPERTIES"]["REV_COMMENT"]["VALUE"];
                    }
                    ?></div>
                </div>
                <?endif;?>
            </div>
        </div>
<?
}
?>
        <script>
        $(document).ready(function(){
            $('.show-text').click(function(){
                $(this).css('display','none');
                $('.hidden-text[data-stid="' + $(this).data('stid') + '"]').css('display','unset');
            });
        });
        </script>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="pr-nav-div"><?=$arResult["NAV_STRING"]?></div>
    <?endif;?>
<?if ($arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->NavPageCount):?>
<?endif;?>
</div>
<?
if (!isset($_REQUEST['SHOWALL_1']) && $arResult["NAV_RESULT"]->NavRecordCount > 2) {
?><div class="row bxr-btn-get-reviews-row">
    <div class="col-xs-12">
        <button class="bxr-btn-invert bxr-btn-get-reviews" data-itemid="<?=$arParams["ELEMENT_ID"]?>">Посмотреть все отзывы</button>
    </div>
</div>
<?}?>