<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>",print_r($arResult["BASKET_ITEMS"]["CAN_BUY"]),"</pre>";

$arMounts = array();
foreach ($arResult["BASKET_ITEMS"]["CAN_BUY"] as $key=>$item) {
    foreach ($item["PROPS"] as $v)
        if ($v["CODE"] == "MOUNT_TARGET" && $v["~VALUE"] != '')
            $arMounts[$key] = $v["~VALUE"];
}

if (sizeof($arMounts) > 0) {
    CModule::IncludeModule('iblock');
    $dbTrgt = CIBlockElement::GetList(array(),array("ID" => $arMounts, "IBLOCK_ID" => "12"), false, false, array("ID", "NAME"));
    while ($res = $dbTrgt->GetNext()) {
        foreach ($arMounts as $key=>$val) {
            if ($val == $res["ID"])
                $arResult["BASKET_ITEMS"]["CAN_BUY"][$key]["NAME"] .= " для ".$res["NAME"];
        }
    }
}
?>