<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

$arFilter = '';
$arFilter = array(array("name" => "sharpen", "precision" => 100));

if(is_array($arResult["DETAIL_PICTURE"]))
{
    $arFileTmp = CFile::ResizeImageGet(
            $arResult["DETAIL_PICTURE"],
            array("width" => 860, "height" => 860),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true, $arFilter
    );
    $arResult['DETAIL_PICTURE_SMALL'] = array(
            'SRC' => $arFileTmp["src"],
            'WIDTH' => $arFileTmp["width"],
            'HEIGHT' => $arFileTmp["height"],
    );
}

