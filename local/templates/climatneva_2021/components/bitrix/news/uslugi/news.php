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

//include_once($_SERVER["DOCUMENT_ROOT"].'/uslugi/index_include.php');

?>
<div class="row uslugi">
    <div class="col-xs-12">
        <div><?
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/uslugi/index_include/index-1.php"
			)
		);?></div>
    <div class="col-xs-12"><?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "uslugi_index",
        Array(
            "VIEW_MODE" => "TEXT",
            "SHOW_PARENT_NAME" => "Y",
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => "",
            "SECTION_CODE" => "",
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
    ?></div>
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
</div>