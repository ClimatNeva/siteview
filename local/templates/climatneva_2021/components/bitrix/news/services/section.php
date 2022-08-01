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

//echo "<pre>",print_r($arParams),"</pre>";
//echo "<pre>",print_r($arResult),"</pre>";

if (!empty($arResult["VARIABLES"]["SECTION_ID"])) {
	$GLOBALS["arrFilter"]["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
} else if (!empty($arResult["VARIABLES"]["SECTION_CODE"])) {
	$GLOBALS["arrFilter"]["CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
}

$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"uslugi_section",
	Array(
		"VIEW_MODE" => "TEXT",
		"FILTER_NAME" => "arrFilter",
		"SHOW_PARENT_NAME" => "Y",
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => $arParams["LIST_FIELD_CODE"],
		"SECTION_USER_FIELDS" => $arParams["LIST_USER_FIELD_CODE"],
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_NOTES" => $arParams["CACHE_NOTES"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"]
	),
	false
);
?>
