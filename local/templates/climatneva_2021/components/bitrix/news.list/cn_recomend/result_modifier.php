<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

foreach($arResult["ITEMS"] as $cell=>$arElement)
{
  if($arElement["PREVIEW_PICTURE"]["ID"])
  {
    $file = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"]["ID"],array('width' => 180,'height' => 260), BX_RESIZE_IMAGE_EXACT, true);
    $arResult["ITEMS"][$cell]["PREVIEW_PICTURE_SMALL"]['SRC'] = $file['src'];
  }
}

$arResult["NAV_STRING"] = strtr($arResult["NAV_STRING"],["phppage-"=>"php/page-"]);