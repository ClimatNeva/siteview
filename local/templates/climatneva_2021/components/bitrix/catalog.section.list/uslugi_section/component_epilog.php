<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//echo "<pre>",print_r($arResult),"</pre>";

$APPLICATION->SetTitle($arResult["SECTION"]["NAME"]);
$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_META_TITLE"]);
$APPLICATION->SetPageProperty("description", $arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"]);

if (!empty($arResult["SECTION"]["UF_HIDE_FROM_ROBOTS"])) {
    $APPLICATION->AddHeadString("<meta name=\"robots\" content=\"noindex\" />");
}
?>