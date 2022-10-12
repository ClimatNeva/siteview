<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arEquip = [];
foreach ($arResult["ITEMS"] as &$item) {
    /* if (!empty($item["PREVIEW_PICTURE"]["ID"])) {
        $item["THUMB"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], ["width" => 650, "height" => 520])["src"];
    } */
    if (!empty($item["PROPERTIES"]["INSTALLED_EQ"]["VALUE"]) && sizeof($item["PROPERTIES"]["INSTALLED_EQ"]["VALUE"])) {
        $arEquip = array_merge($arEquip, $item["PROPERTIES"]["INSTALLED_EQ"]["VALUE"]);
    }
}

if (!empty($arEquip)) {
    CModule::IncludeModule('iblock');
    $arSelect = ["ID", "NAME", "DETAIL_PAGE_URL"];
    $res = CIBlockElement::GetList([], ["IBLOCK_ID" => "12", "ID" => $arEquip], false, false, $arSelect);
    while ($row = $res->GetNext()) {
        $arResult["EQUIP"][$row["ID"]] = $row;
    }
}