<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Alexkova\Market\Core;
global $APPLICATION;

$BXReady = \Alexkova\Market\Core::getInstance();
$areaType = $BXReady->getAreaType('left_menu_type');?>

<?if ($areaType == 'v2') {
    $aMenuLinksExt = $APPLICATION->IncludeComponent(
            "alexkova.market:menu.sections",
            "",
            Array(
                    "IS_SEF" => "Y",
                    "ID" => $_REQUEST["ID"],
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "12",
                    "SECTION_URL" => "",
                    "DEPTH_LEVEL" => "3",
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "36000000",
                    "SEF_BASE_URL" => "/catalog/",
                    "SECTION_PAGE_URL" => "#SECTION_CODE#/",
                    "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/"
            ),
            false,
            array("HIDE_ICONS" => "Y")
    );

    foreach ($aMenuLinksExt as &$val){
            $val["DEPTH_LEVEL"]++;
    };
} elseif ($areaType == 'v3') {
    $img = array();
    $ib = CIBlock::GetByID("12")->GetNext();

    if(!empty($ib["PICTURE"]))
       $img =  array("PICTURE" => $ib["PICTURE"]);
    
    $aMenuLinksExt = Array(
        Array(
                "Каталог", 
                "/catalog/",
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