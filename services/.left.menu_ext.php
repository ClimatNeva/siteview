<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Alexkova\Market\Core;
global $APPLICATION;

$BXReady = \Alexkova\Market\Core::getInstance();
$areaType = $BXReady->getAreaType('left_menu_type');

$IBLOCK_ID = "23";

if ($areaType == 'v2') {
    $aMenuLinksExt = $APPLICATION->IncludeComponent(
            "alexkova.market:menu.sections",
            "",
            Array(
                    "IS_SEF" => "Y",
                    "ID" => $_REQUEST["ID"],
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => $IBLOCK_ID ,
                    "SECTION_URL" => "",
                    "DEPTH_LEVEL" => "3",
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "36000000",
                    "SEF_BASE_URL" => "/services/",
                    "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
                    "DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/"
            ),
            false,
            array("HIDE_ICONS" => "Y")
    );

    foreach ($aMenuLinksExt as &$val){
            $val["DEPTH_LEVEL"]++;
    };
} elseif ($areaType == 'v3') {
    $img = array();
    $ib = CIBlock::GetByID($IBLOCK_ID )->GetNext();

    if(!empty($ib["PICTURE"]))
       $img =  array("PICTURE" => $ib["PICTURE"]);
    
    $aMenuLinksExt = Array(
        Array(
                "Виды деятельности", 
                "/uslugi/",
                Array(), 
                $img, 
                "" 
        )
    );
};

if ($areaType == 'v2') {
    $aMenuLinks = $aMenuLinksExt;
} else {
    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}
?>