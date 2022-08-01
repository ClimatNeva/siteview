<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!empty($arParams["IBLOCK_ID"])) {
    CModule::IncludeModule('iblock');
    $arResult["IBLOCK"] = CIBlock::GetByID(intval($arParams["IBLOCK_ID"]))->GetNext();
    $this->__component->SetResultCacheKeys(array("IBLOCK"));
}
?>