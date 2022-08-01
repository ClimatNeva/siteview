    <?
    $APPLICATION->IncludeComponent(
        "alexkova.market:sort.panel", 
        "with-tags", 
        array(
            "COMPONENT_TEMPLATE" => "with-tags",
            "IBLOCK_ID" => "12",
            "IBLOCK_TYPE" => "catalog",
            "SECTION_CODE" => "",
            "THEME" =>  "default",
            "ELEMENT_SORT_FIELD" => array(
                "0" => "PROPERTYSORT_SALELEADER",
                "1" => "PROPERTY_MINIMUM_PRICE",
            ),
            "ELEMENT_SORT_ORDER" => "asc",
            "PAGE_ELEMENT_COUNT_SHOW" => "Y",
            "PAGE_ELEMENT_COUNT" => "36",
            "PAGE_ELEMENT_COUNT_LIST" => array("0"=>""),
            "CATALOG_VIEW_SHOW" => "Y",
            "DEFAULT_CATALOG_VIEW" => "TITLE",
            "CATALOG_DEFAULT_SORT" => "PROPERTYSORT_SALELEADER",
            "CATALOG_DEFAULT_SORT_ORDER" => "asc,nulls",
            "FILTER_NAME" => "arrFilter",
        ),
        false,
        array(
                "HIDE_ICONS" => "Y"
        )
    );
	
$elementBlock = 'system#ecommerce_v1';
$elementList = 'system#ecommerce_v1_list';
$elementTable = 'system#ecommerce_v1_table';

	if (isset($_SESSION["USER_SORTPANEL"]) && is_array($_SESSION["USER_SORTPANEL"]))
	{
		foreach ($_SESSION["USER_SORTPANEL"] as $cell=>$val)
		{
			$_REQUEST[$cell] = $val;
		}
	}

	global $arSortGlobal;
	$sort = $arSortGlobal["sort"];
	$sort_order = $arSortGlobal["sort_order"];
	$num = $arSortGlobal["num"];
	$view = $arSortGlobal["view"]; 

//	$view = trim(strip_tags($_REQUEST["view"]));

	$arDefaultResponsive = array(
		"LG" => 3,
		"MD" => 3,
		"SM" => 4,
		"XS" => 6
	);

	if(in_array($view,array('.default','list','table'))){
		switch ($view){
			case "list":
				$elementLibrary = $elementList;
				$arResponsiveParams = array(
					"LG" => 12,
					"MD" => 12,
					"SM" => 12,
					"XS" => 12
				);
				break;
			case "table":
				$elementLibrary = $elementTable;
				$arResponsiveParams = array(
					"LG" => 12,
					"MD" => 12,
					"SM" => 12,
					"XS" => 12
				);
				break;

			default:
				$elementLibrary = $elementBlock;
				$arResponsiveParams = $arDefaultResponsive;
				break;
		}
	}
	else{
		$elementLibrary = $elementBlock;
		$arResponsiveParams = $arDefaultResponsive;
	}
     
        if ($managment_element_mode == "Y") {
            if ($elementLibrary == $elementBlock) {
                $ownOptElementLib = COption::GetOptionString($module_id, "own_catalog_list_element_type_".SITE_TEMPLATE_ID, $elementBlock);
                if (strlen($ownOptElementLib) > 0) {
                    $optElementLib = trim($ownOptElementLib); 
                } else {
                    $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_".SITE_TEMPLATE_ID, $elementBlock);
                }
                $arResponsiveParams["LG"] = COption::GetOptionString($module_id, "catalog_list_element_count_lg_".SITE_TEMPLATE_ID, 4);
                $arResponsiveParams["MD"] = COption::GetOptionString($module_id, "catalog_list_element_count_md_".SITE_TEMPLATE_ID, 3);
                $arResponsiveParams["SM"] = COption::GetOptionString($module_id, "catalog_list_element_count_sm_".SITE_TEMPLATE_ID, 2);
                $arResponsiveParams["XS"] = COption::GetOptionString($module_id, "catalog_list_element_count_xs_".SITE_TEMPLATE_ID, 1);
            } elseif ($elementLibrary == $elementList) {
                $nameListOption = substr("own_catalog_list_element_type_list_".SITE_TEMPLATE_ID, 0,50);
                $ownOptElementLib = COption::GetOptionString($module_id, $nameListOption, $elementList);
                if (strlen($ownOptElementLib) > 0) {
                    $optElementLib = trim($ownOptElementLib); 
                } else {
                    $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_list_".SITE_TEMPLATE_ID, $elementList);
                }
            } elseif ($elementLibrary == $elementTable) {
                $nameTableOption = substr("own_catalog_list_element_type_table_".SITE_TEMPLATE_ID, 0,50);
                $ownOptElementLib = COption::GetOptionString($module_id, $nameTableOption, $elementTable);
                if (strlen($ownOptElementLib) > 0) {
                    $optElementLib = trim($ownOptElementLib); 
                } else {
                    $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_table_".SITE_TEMPLATE_ID, $elementTable);
                }
            };
            if (strlen($optElementLib) > 0)
                    $elementLibrary = $optElementLib;
        }
    if ($sort == 'PROPERTY_MINIMUM_PRICE') {
        $sort_1 = 'PROPERTY_NOT2SHOW_PRICE_ABOVE_ZERO';
        $sort_order_1 = 'desc';
        $sort_2 = $sort;
        $sort_order_2 = $sort_order;
    } else {
        $sort_1 = $sort;
        $sort_order_1 = $sort_order;
        $sort_2 = $arParams["ELEMENT_SORT_FIELD2"];
        $sort_order_2 = $arParams["ELEMENT_SORT_ORDER2"];
    }

    $GLOBALS["arrFilter"]["!PROPERTY_DESIGNERS"] = false;

	$APPLICATION->IncludeComponent(
		"bxready:ecommerce.list",
		".default",
		array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "12",
			"ELEMENT_SORT_FIELD" => $sort_1,
			"ELEMENT_SORT_ORDER" => $sort_order_1,
			"ELEMENT_SORT_FIELD2" => $sort_2,
			"ELEMENT_SORT_ORDER2" => $sort_order_2,
			"PROPERTY_CODE" => array(),
			"META_KEYWORDS" => "-",
			"META_DESCRIPTION" => "-",
			"BROWSER_TITLE" => "-",
            "SET_LAST_MODIFIED" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
			"INCLUDE_SUBSECTIONS" => "Y",
			"BASKET_URL" => "/personal/basket/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"SECTION_ID_VARIABLE" => "SECTION_CODE",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"FILTER_NAME" => "arrFilter",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "0",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"SET_TITLE" => "Y",
			"MESSAGE_404" => "",
			"SET_STATUS_404" => "Y",
			"SHOW_404" => "Y",
			"FILE_404" => "",
			"DISPLAY_COMPARE" => "Y",
			"PAGE_ELEMENT_COUNT" => $num,
			"LINE_ELEMENT_COUNT" => $num,
			"PRICE_CODE" => array("0"=>"BASE"),
			"USE_PRICE_COUNT" => "N",
			"SHOW_PRICE_COUNT" => "0",

			"PRICE_VAT_INCLUDE" => "Y",
			"USE_PRODUCT_QUANTITY" => "Y",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRODUCT_PROPERTIES" => "",

			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Товары",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "0",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_BASE_LINK" => "",
			"PAGER_PARAMS_NAME" => "",

			"OFFERS_CART_PROPERTIES" => array("0" => "SIZE"),
			"OFFERS_FIELD_CODE" => array("0"=>"NAME"),
			"OFFERS_PROPERTY_CODE" => array("0"=>""),
			"OFFERS_SORT_FIELD" => "shows",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_FIELD2" => "shows",
			"OFFERS_SORT_ORDER2" => "asc",
            "OFFERS_LIMIT" => 0,
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_URL" => "/catalog/#SECTION_CODE#/",
			"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			'CONVERT_CURRENCY' => "Y",
			'CURRENCY_ID' => "RUB",
			'HIDE_NOT_AVAILABLE' => "N",

			'LABEL_PROP' => "-",
			'ADD_PICT_PROP' => "MORE_PHOTO",
			'PRODUCT_DISPLAY_MODE' => "Y",

			'OFFER_ADD_PICT_PROP' => "-",
			'OFFER_TREE_PROPS' => "",
			'PRODUCT_SUBSCRIPTION' => "",
			'SHOW_DISCOUNT_PERCENT' => "Y",
			'SHOW_OLD_PRICE' => "Y",
			'MESS_BTN_BUY' => "Купить",
			'MESS_BTN_ADD_TO_BASKET' => "В корзину",
			'MESS_BTN_SUBSCRIBE' => "",
			'MESS_BTN_DETAIL' => "Подробнее",
			'MESS_NOT_AVAILABLE' => "Нет в наличии",

			'TEMPLATE_THEME' => "site",
			"ADD_SECTIONS_CHAIN" => "N",
			'ADD_TO_BASKET_ACTION' => "",
			'SHOW_CLOSE_POPUP' => "N",
			'COMPARE_PATH' => "/catalog/compare.php?action=#ACTION_CODE#",
			'BACKGROUND_IMAGE' => "-",
			"BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "12",
			"BXREADY_LIST_PAGE_BLOCK_TITLE" => "",
			"BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
			"BXREADY_LIST_LG_CNT" => $arResponsiveParams["LG"],
			"BXREADY_LIST_MD_CNT" => $arResponsiveParams["MD"],
			"BXREADY_LIST_SM_CNT" => $arResponsiveParams["SM"],
			"BXREADY_LIST_XS_CNT" => $arResponsiveParams["XS"],
			"BXREADY_LIST_SLIDER" => "N",
			"BXREADY_ELEMENT_DRAW" => $elementLibrary,
			"BXREADY_LIST_VERTICAL_SLIDER_MODE" => "N",
			"BXREADY_LIST_HIDE_SLIDER_ARROWS" => "Y",
			"BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "N",
			"BXREADY_LIST_MARKER_TYPE" => "system#ribbon_vertical",
			"USE_VOTE_RATING" => "Y",
			"VOTE_DISPLAY_AS_RATING" => "rating",
                        "SHOW_CATALOG_QUANTITY_CNT" => "N",
                        "SHOW_CATALOG_QUANTITY" => "N",
                        "QTY_SHOW_TYPE" => "NUM",
                        "IN_STOCK" => "В наличии",
                        "NOT_IN_STOCK" => "Нет в наличии",
                        "QTY_MANY_GOODS_INT" => "3",
                        "QTY_MANY_GOODS_TEXT" => "много",
                        "QTY_LESS_GOODS_TEXT" => "мало",
                        "OFFERS_VIEW" => "SELECT",
                        "SKU_PROPS_SHOW_TYPE" => "rounded",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ANOUNCE_TRUNCATE_LEN" => "",
                        "TILE_SHOW_PROPERTIES" => "N"
		),
		false,
		array("HIDE_ICONS" => "Y")
	);?>
