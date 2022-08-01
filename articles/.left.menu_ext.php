<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Alexkova\Market\Core;
global $APPLICATION;
$BXReady = \Alexkova\Market\Core::getInstance();
$areaType = $BXReady->getAreaType('left_menu_type');

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"alexkova.market:menu.sections",
	"",
	Array(
		"IS_SEF" => "Y",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "2",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "3",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"SEF_BASE_URL" => "/articles/",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/"
	),
        false,
        array("HIDE_ICONS" => "N")
);

foreach ($aMenuLinksExt as $k => &$val){
    if($k!="PICTURE")
	$val["DEPTH_LEVEL"]++;
}

if ($areaType == 'v2') {
    $aMenuLinks = $aMenuLinksExt;
} else {
    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>