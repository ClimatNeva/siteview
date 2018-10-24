<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
?><?$APPLICATION->IncludeComponent(
	"alexkova.market:promo",
	"ribbon",
	Array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "ribbon",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DISPLAY_TYPE" => "block",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"DETAIL_PICTURE",3=>"",),
		"HOVER_EFFECT" => "goliath",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_SUBSECTIONS" => "N",
		"NEWS_COUNT" => "4",
		"PARENT_SECTION" => "160",
		"PROPERTY_CODE" => array(0=>"PROMO_HIDE_NAME",1=>"",)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>