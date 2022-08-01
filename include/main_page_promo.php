<div id="bxr-opportunities">
	<?$APPLICATION->IncludeComponent(
		"bxready:block.list",
		".default",
		Array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BXREADY_ELEMENT_DRAW" => "system#flaticon.list.v1",
			"BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "12",
			"BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "N",
			"BXREADY_LIST_HIDE_MOBILE_SLIDER_AUTOSCROLL" => "N",
			"BXREADY_LIST_HIDE_SLIDER_ARROWS" => "Y",
			"BXREADY_LIST_LG_CNT" => "4",
			"BXREADY_LIST_MD_CNT" => "4",
			"BXREADY_LIST_PAGE_BLOCK_TITLE" => "",
			"BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "fa fa-user",
			"BXREADY_LIST_SLIDER" => "Y",
			"BXREADY_LIST_SLIDER_MARKERS" => "Y",
			"BXREADY_LIST_SM_CNT" => "12",
			"BXREADY_LIST_VERTICAL_SLIDER_MODE" => "N",
			"BXREADY_LIST_XS_CNT" => "12",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "N",
			"CHECK_DATES" => "Y",
			"COMPONENT_TEMPLATE" => ".default",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(0=>"",1=>"",),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "7",
			"IBLOCK_TYPE" => "content",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"NEWS_COUNT" => "3",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(0=>"",1=>"",),
			"SET_BROWSER_TITLE" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC"
		)
	);?>
    </div>
<?$APPLICATION->IncludeComponent(
	"alexkova.market:promo", 
	"ribbon", 
	array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "ribbon",
		"DISPLAY_TYPE" => "block",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"HOVER_EFFECT" => "goliath",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "9",
		"PARENT_SECTION" => "159",
		"PROPERTY_CODE" => array(
			0 => "PROMO_HIDE_NAME",
			1 => "",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"alexkova.market:catalog.bestsellers", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"BESTSELLER_IBLOCK_TYPE" => "content",
		"BESTSELLER_IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "12",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "110%",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		0 => "NEWPRODUCT",
			1 => "SALELEADER",

		),
		"OFFERS_CART_PROPERTIES" => array(
		),
		"BXREADY_LIST_PAGE_BLOCK_TITLE" => "Рекомендуем",
		"BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
		"BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "10",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"BXREADY_LIST_LG_CNT" => "2",
		"BXREADY_LIST_MD_CNT" => "2",
		"BXREADY_LIST_SM_CNT" => "5",
		"BXREADY_LIST_XS_CNT" => "5",
		"BXREADY_LIST_SLIDER" => "Y",
		"BXREADY_ELEMENT_DRAW" => "system#ecommerce.v2.lite",
		"BXREADY_LIST_VERTICAL_SLIDER_MODE" => "Y",
		"BXREADY_LIST_HIDE_SLIDER_ARROWS" => "N",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "Y",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_AUTOSCROLL" => "N",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_SCROLLSPEED" => "2000",
		"BXREADY_LIST_SLIDER_MARKERS" => "Y",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "CML2_LINK"
		)
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
<?
$GLOBALS["arrFilter"] = array("!IBLOCK_SECTION_ID"=>"161");
?>
<?
$APPLICATION->IncludeComponent(
	"alexkova.market:catalog.markers",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"BESTSELLER_IBLOCK_TYPE" => "content",
		"BESTSELLER_IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "12",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "8",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "110%",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
			0 => "NEWPRODUCT",
			1 => "SALELEADER",
			2 => "DESIGNERS",
		),
		"OFFERS_CART_PROPERTIES" => array(
		),
		"BXREADY_LIST_PAGE_BLOCK_TITLE" => "",
		"BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
		"BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "10",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"BXREADY_LIST_LG_CNT" => "2",
		"BXREADY_LIST_MD_CNT" => "2",
		"BXREADY_LIST_SM_CNT" => "5",
		"BXREADY_LIST_XS_CNT" => "5",
		"BXREADY_LIST_SLIDER" => "Y",
		"BXREADY_ELEMENT_DRAW" => "system#ecommerce.v2.lite",
		"TAB_ACTION_SETTING" => "Y",
		"TAB_ACTION_SORT" => "100",
		"TAB_RECCOMEND_SETTING" => "Y",
		"TAB_RECCOMEND_SORT" => "200",
		"TAB_NEW_SETTING" => "Y",
		"TAB_NEW_SORT" => "300",
		"TAB_HIT_SETTING" => "Y",
		"TAB_HIT_SORT" => "400",
		"TAB_DESIGNERS_SETTING" => "Y",
		"TAB_DESIGNERS_SORT" => "500",
		"BXREADY_LIST_VERTICAL_SLIDER_MODE" => "N",
		"BXREADY_LIST_HIDE_SLIDER_ARROWS" => "Y",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "N",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_AUTOSCROLL" => "Y",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_SCROLLSPEED" => "2000",
		"BXREADY_LIST_SLIDER_MARKERS" => "Y",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "CML2_LINK"
		)
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>


<?$APPLICATION->IncludeComponent(
	"bxready:block.list",
	".default",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BXREADY_ELEMENT_DRAW" => "system#classic.image.v1",
		"BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "12",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "N",
		"BXREADY_LIST_HIDE_MOBILE_SLIDER_AUTOSCROLL" => "N",
		"BXREADY_LIST_HIDE_SLIDER_ARROWS" => "Y",
		"BXREADY_LIST_LG_CNT" => "3",
		"BXREADY_LIST_MD_CNT" => "3",
		"BXREADY_LIST_PAGE_BLOCK_TITLE" => "Акции",
		"BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
		"BXREADY_LIST_SLIDER" => "N",
		"BXREADY_LIST_SLIDER_MARKERS" => "Y",
		"BXREADY_LIST_SM_CNT" => "4",
		"BXREADY_LIST_VERTICAL_SLIDER_MODE" => "N",
		"BXREADY_LIST_XS_CNT" => "6",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "4",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Обзоры",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);?>