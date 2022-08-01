
<?
$APPLICATION->SetAdditionalCSS("/bitrix/tools/bxready/library/elements/ecommerce_v1/include/style.css");
$IBLOCK_ID = "12";
$SECTION_ID = "161";
$arSort = array(
	"PROPERTY_MINIMUM_PRICE" => "asc",
	"NAME" => "asc"
);
$arFilter = array(
	"IBLOCK_ID" => $IBLOCK_ID,
	"SECTION_ID" => $SECTION_ID,
    "PROPERTY_AKCIY_MONTAZH" => "166"
);

$dbRes = CIBlockElement::GetList($arSort,$arFilter,false,false,array("ID","PREVIEW_PICTURE","DETAIL_PAGE_URL","PROPERTY_AKCIY_MONTAZH"));
while ($item = $dbRes->GetNext()) {
	$arPrice = CPrice::GetBasePrice($item["ID"]);
	$showPrice = intval($arPrice["PRICE"])." руб";
	$imagePreview = CFile::ResizeImageGet($item["PREVIEW_PICTURE"],array("width" => "160", "height" => "160"),BX_RESIZE_IMAGE_PROPORTIONAL )["src"];
	?>
	<div class="t_2 col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="bxr-ecommerce-v1" data-uid="2" data-resize="1" style="height: 287px;">
			<div class="bxr-element-container" style="height: 275px;">
				<div class="bxr-element-image">
					<a href="<?=$item["DETAIL_PAGE_URL"];?>">
						<img src="<?=$imagePreview;?>" alt="<?=$item["NAME"];?>" title="<?=$item["NAME"];?>">
					</a>
				</div>
				<div class="bxr-ribbon-marker-vertical">
				</div>
				<div class="bxr-element-name" style="height: 20px;">
					<a href="<?=$item["DETAIL_PAGE_URL"];?>" title="<?=$item["NAME"];?>"><?=$item["NAME"];?></a>
				</div>
				<div class="clearfix"></div>
				<div class="bxr-element-price">
					<div class="bxr-product-price-wrap">
						<div class="bxr-market-item-price bxr-format-price">
							<span class="bxr-market-current-price bxr-market-format-price"><?=$showPrice;?></span>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
}
//endwhile;
?>
<?/*
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "",
    Array(
        "ACTION_VARIABLE" => "action",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "BASKET_URL" => "/personal/basket.php",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "0",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "name",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "arrFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "IBLOCK_ID" => "12",
        "IBLOCK_TYPE" => "catalog",
        "INCLUDE_SUBSECTIONS" => "Y",
        "LINE_ELEMENT_COUNT" => "3",
        "LOAD_ON_SCROLL" => "N",
        "MESSAGE_404" => "",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_LAZY_LOAD" => "Показать ещё",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Монтаж",
        "PAGE_ELEMENT_COUNT" => "18",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array("BASE"),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(),
        "PROPERTY_CODE_MOBILE" => array(),
        "SECTION_CODE" => "",
        "SECTION_ID" => "161",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array(""),
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SHOW_ALL_WO_SECTION" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_FROM_SECTION" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N"
    )
);*/
?>