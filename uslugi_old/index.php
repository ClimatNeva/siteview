<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Проектирование, поставка и монтаж систем кондиционирования воздуха в Санкт-Петербурге. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Виды деятельности компании Климат Нева");
$APPLICATION->SetTitle("Виды деятельности");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div class="row uslugi">
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
    </div>
    <div class="col-xs-12">
        <ul class="uslugi-box">
            <li><a href="/uslugi/konditsionery/">Кондиционирование</a></li>
            <li><a href="/uslugi/teplovoe-oborudovanie/">Тепловое оборудование</a></li>
            <li><a href="/uslugi/ventilyatsiya/">Системы вентиляции</a></li>
            <li><a href="/uslugi/uvlazhniteli-vozdukha/">Увлажнители воздуха</a></li>
            <li><a href="/uslugi/osushiteli/">Осушители воздуха</a></li>
            <li><a href="/uslugi/ochistiteli-vozdukha/">Очистители воздуха</a></li>
        </ul>
    </div>
    <div class="col-xs-12">
        <h2>Как мы работаем</h2>
        <ol class="uslugi-counter-ol">
            <li>Проектирование</li>
            <li>Подбор и расчет</li>
            <li>Поставка оборудования</li>
            <li>Монтаж</li>
        </ol>
    </div>
    <div class="col-xs-12">
        <h2>Где мы работаем</h2>
        <div class="img-box"><img src="/images/uslugi/uslugi-map.jpg" alt="Где мы работаем"></div>
    </div>
    <div class="col-xs-12">
        <?
            include_once($_SERVER['DOCUMENT_ROOT'].'/uslugi/include/zakaz-form.php');
        ?>
    </div>
</div>

<?/*$APPLICATION->IncludeComponent(
	"alexkova.market:promo", 
	"ribbon", 
	array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "ribbon",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
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
		"INCLUDE_SUBSECTIONS" => "N",
		"NEWS_COUNT" => "6",
		"PARENT_SECTION" => "158",
		"PROPERTY_CODE" => array(
			0 => "PROMO_HIDE_NAME",
			1 => "",
		)
	),
	false
);*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>