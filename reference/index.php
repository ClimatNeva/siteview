<?
$GLOBALS["templateType"] = "one_col";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Объекты, отзывы, рекомендации | Кондиционеры, вентиляция и камины с установкой в Санкт-Петербурге. Бесплатный выезд специалистов. Доставка и монтаж. ☎ Звоните: 8 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Объекты, отзывы, рекомендации | Купить кондиционер и вентиляцию в Санкт-Петербурге. Цены, доставка, монтаж | Климат Нева ");
$APPLICATION->SetTitle("Рекомендации");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/objects.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.flexslider.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.easing.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.mousewheel.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/bootstrap.modal.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/bootstrap-carousel.min.js');
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/modal_win.css");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/objects.css");

$setCacheTime = "0";
?>
<div class="recomends">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-links">
                <ul>
                    <li><a href="#objects" class="page-links-a">Объекты</a></li>
                    <li><a href="#reviews" class="page-links-a">Отзывы</a></li>
                    <li><a href="#recomend" class="page-links-a">Рекомендательные письма</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2><a name="objects" id="objects"></a>Объекты</h2>
            <div class="ajax-objects-div">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
           <h2><a name="reviews" id="reviews"></a>Отзывы</h2>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "cn_reviews",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => $setCacheTime,
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("ID","NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "17",
                    "IBLOCK_TYPE" => "content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MEDIA_PROPERTY" => "",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("POSITION","CITY","OBJ_NAME","OBJ_ICON",""),
                    "SEARCH_PAGE" => "/search/",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SLIDER_PROPERTY" => "",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "USE_RATING" => "N",
                    "USE_SHARE" => "N"
                )
            );?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
           <h2><a name="recomend" id="recomend"></a>Рекомендательные письма</h2>
            <div class="ajax-recomend-div">
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>