<section class="slider_block"><?
// Слайдер
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "index.slider",
    Array(
        "IBLOCK_ID" => "24",
        "IBLOCK_TYPE" => "content",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "ACTIVE_DATE_FORMAT" => "",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "360000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => [],
        "FILTER_NAME" => "arrrFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "10",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("LINK","SMALL_IMAGE","MEDIUM_IMAGE"),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "",
        "STRICT_SECTION_CHECK" => "N"
    )
);


// Блок преимуществ
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "index.benefits",
    Array(
        "IBLOCK_ID" => "7",
        "IBLOCK_TYPE" => "content",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "ACTIVE_DATE_FORMAT" => "",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "360000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => [],
        "FILTER_NAME" => "arrrFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "3",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("ICON",""),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "",
        "STRICT_SECTION_CHECK" => "N"
    )
);
?></section>

<section class="standard-section"><?
global $catFilter;
$catFilter["!UF_2LEVEL_MENU"] = "false";
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "index.catalog.menu",
    Array(
        "VIEW_MODE" => "TEXT",
        "SHOW_PARENT_NAME" => "Y",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "12",
        "SECTION_ID" => "",
        "SECTION_CODE" => "",
        "SECTION_URL" => "",
        "COUNT_ELEMENTS" => "N",
        "FILTER_NAME" => "catFilter",
        "TOP_DEPTH" => "3",
        "SECTION_FIELDS" => "",
        "SECTION_USER_FIELDS" => array("UF_SORT","UF_2LEVEL_MENU","UF_2LEVEL_ICON"),
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",
        "CUSTOM_SECTION_SORT" => ["UF_SORT"=>"asc"],
    )
);
?></section>

<section class="standard-section"><?
global $servFilter;
$servFilter["!UF_SHOW_ON_INDEX"] = "false";
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "index.services.menu",
    Array(
        "VIEW_MODE" => "TEXT",
        "SHOW_PARENT_NAME" => "Y",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "23",
        "SECTION_ID" => "",
        "SECTION_CODE" => "",
        "SECTION_URL" => "",
        "COUNT_ELEMENTS" => "N",
        "FILTER_NAME" => "servFilter",
        "TOP_DEPTH" => "2",
        "SECTION_FIELDS" => "DETAIL_PICTURE",
        "SECTION_USER_FIELDS" => array("UF_SORT","UF_SHOW_ON_INDEX"),
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",
        "CUSTOM_SECTION_SORT" => ["UF_SORT"=>"asc"],
    )
);
?></section>

<section class="triz"><?
    $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "cn.index.podbor",//"",
        Array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => "5",
            "LIST_URL" => "result_list.php",
            "EDIT_URL" => "result_edit.php",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SEF_FOLDER" => "/",
            "VARIABLE_ALIASES" => Array(
                "WEB_FORM_ID" => "form_id",
                "RESULT_ID" => "result_id"
            ),
            "SHOW_AGREEMENT" => "N",
            "SHOW_TITLE" => "Y",
            "MEDIALIBRARY_COLLECTION" => "16"
        )
    );
?></section>

<section class="standard-section"><?
global $solFilter;
$solFilter["!UF_SHOW_ON_INDEX"] = "false";
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "index.solutions.menu",
    Array(
        "VIEW_MODE" => "TEXT",
        "SHOW_PARENT_NAME" => "Y",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "22",
        "SECTION_ID" => "",
        "SECTION_CODE" => "",
        "SECTION_URL" => "",
        "COUNT_ELEMENTS" => "N",
        "FILTER_NAME" => "solFilter",
        "TOP_DEPTH" => "2",
        "SECTION_FIELDS" => "DETAIL_PICTURE",
        "SECTION_USER_FIELDS" => array("UF_SORT","UF_SHOW_ON_INDEX"),
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",
        "CUSTOM_SECTION_SORT" => ["UF_SORT"=>"asc"],
    )
);
?></section>

<section class="certs">
    <div class="certs__left-box">
        <div class="certs__left-text-box">
            <h2><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_certs_title.php",[],["MODE"=>"html"]);?></h2>
            <div class="certs__left-text"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_certs_text.php",[],["MODE"=>"html"]);?></div>
        </div>
    </div>
    <div class="certs__bottom-box">
        <div class="container">
            <ul class="certs__trio">
                <li>
                    <div class="certs__trio-title"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_trio_title_1.php",[],["MODE"=>"html"]);?></div>
                    <div class="certs__trio-text"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_trio_text_1.php",[],["MODE"=>"html"]);?></div>
                </li>
                <li>
                    <div class="certs__trio-title"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_trio_title_2.php",[],["MODE"=>"html"]);?></div>
                    <div class="certs__trio-text"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_trio_text_2.php",[],["MODE"=>"html"]);?></div>
                </li>
                <li>
                    <div class="certs__trio-title"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_trio_title_3.php",[],["MODE"=>"html"]);?></div>
                    <div class="certs__trio-text"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_trio_text_3.php",[],["MODE"=>"html"]);?></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="certs__right-box">
        <div class="certs__right-box__bg-image"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_certs_bg_image.php",[],["MODE"=>"html"]);?></div><?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "index.certificates",
            Array(
                "IBLOCK_ID" => "25",
                "IBLOCK_TYPE" => "content",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "ACTIVE_DATE_FORMAT" => "",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "360000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => [],
                "FILTER_NAME" => "arrrFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "10",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("",""),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "",
                "STRICT_SECTION_CHECK" => "N"
            )
        );
    ?></div>
</section>

<section class="standard-section">
    <div class="container">
        <h2>Бренды</h2><?
            $APPLICATION->IncludeComponent(
            "bitrix:highloadblock.list",
            "brands",
            Array(
                "BLOCK_ID" => "2",
                "CHECK_PERMISSIONS" => "N",
                "DETAIL_URL" => "detail.php?BLOCK_ID=#BLOCK_ID#&ROW_ID=#ID#",
                "FILTER_NAME" => "myfilter",
                "PAGEN_ID" => "page",
                "ROWS_PER_PAGE" => "50",
                "SORT_FIELD" => "UF_SORT",
                "SORT_ORDER" => "ASC"
            )
        );
    ?></div>
</section>

<section class="objects">
    <div class="objects__center-box">
        <h2>Объекты</h2>
    </div>
    <div class="objects-bg"><?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "index.objects",
            Array(
                "IBLOCK_ID" => "16",
                "IBLOCK_TYPE" => "content",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "ACTIVE_DATE_FORMAT" => "",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "360000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => [],
                "FILTER_NAME" => "arrrFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "10",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("INSTALLED_EQ","TAGS"),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "",
                "STRICT_SECTION_CHECK" => "N"
            )
        );
    ?></div>
</section>

<section class="standard-section">
    <div class="container">
        <h2 class="index__about"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_about_title.php",[],["MODE"=>"html"]);?></h2>
        <div class="index__about-text"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_about_text.php",[],["MODE"=>"html"]);?></div>
    </div>
</section>
