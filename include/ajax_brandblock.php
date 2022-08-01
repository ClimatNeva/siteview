<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");?>
<?$APPLICATION->RestartBuffer();?>
<?
$unicumID = 1;
if (isset($_REQUEST["unicumID"])) {
    $unicumID = intval($_REQUEST["unicumID"]);
}
?>
<?$APPLICATION->IncludeComponent(
	"alexkova.market:catalog.brandblock",
	"brand_slider_ajax",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "12",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"PROP_CODE" => array(
			0 => "",
			1 => "Manufacturer",
			2 => "",
		),
		"WIDTH" => "200",
		"HEIGHT" => "70",
		"WIDTH_SMALL" => "200",
		"HEIGHT_SMALL" => "70",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "brand_slider",
		"SHOW_DEACTIVATED" => "N",
		"SINGLE_COMPONENT" => "Y",
		"ELEMENT_COUNT" => "15",
		"BRAND_SHUFFLE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "UNICUM_ID" => $unicumID
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
<script>
document.addEventListener("DOMContentLoaded",function() {
    //runSlider();
});
</script>
