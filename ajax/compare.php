<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$template = ".default";
if (isset($_SESSION["BXR_BASKET_COMPARE"]) && strlen($_SESSION["BXR_BASKET_COMPARE"])>0)
	$template= $_SESSION["BXR_BASKET_COMPARE"];
?>
<?$APPLICATION->IncludeComponent(
	"alexkova.market:catalog.compare.list",
	$template,
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => '12',
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"DETAIL_URL" => "",
		"COMPARE_URL" => SITE_DIR."catalog/compare.php",
		"NAME" => "CATALOG_COMPARE_LIST"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
