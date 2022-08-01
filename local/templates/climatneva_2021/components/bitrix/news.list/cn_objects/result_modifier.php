<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

//echo "<pre>",print_r($arParams),"</pre>";

$dbList = CIBlockProperty::GetPropertyEnum($arParams["FILTER_FIELD_CODE"]["0"], Array($arParams["FILTER_SORT"] => $arParams["FILTER_SORT_ORDER"]), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
while ($arList = $dbList->GetNext())
{
    $arResult["FILTER_PROPERTY_TAGS"][$arList["ID"]] = $arList["VALUE"];
}

global $arrFilter;
foreach ($arrFilter["PROPERTY_TAGS"] as $val) {
    $arResult["FILTER_CHECKED_TAGS"][$val] = "checked";
}

$arFilter = '';
$arFilter = array(array("name" => "sharpen", "precision" => 100));


foreach($arResult["ITEMS"] as $key => $arItem):
	if(is_array($arItem["PREVIEW_PICTURE"]))
	{
		$mult = max($arItem["PREVIEW_PICTURE"]["WIDTH"]/541, $arItem["PREVIEW_PICTURE"]["HEIGHT"]/409);
        $arFileTmp = CFile::ResizeImageGet(
                $arItem["PREVIEW_PICTURE"],
                array("width" => $arItem["PREVIEW_PICTURE"]["WIDTH"]/$mult, "height" => $arItem["PREVIEW_PICTURE"]["HEIGHT"]/$mult),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true, $arFilter
        );
        $arResult["ITEMS"][$key]['PREVIEW_PICTURE_SMALL'] = array(
                'SRC' => $arFileTmp["src"],
                'WIDTH' => $arFileTmp["width"],
                'HEIGHT' => $arFileTmp["height"],
        );
	}
	foreach ($arItem["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $k => $photo) {
		$arFile = CFile::GetFileArray($photo);
		$mult = max($arFile["WIDTH"]/541, $arFile["HEIGHT"]/409);
        $arFileTmp = CFile::ResizeImageGet(
                $arFile,
                array("width" => $arFile["WIDTH"]/$mult, "height" => $arFile["HEIGHT"]/$mult),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true, $arFilter
        );
        $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"]["MORE_PHOTO_SMALL"]["VALUE"][$k] = array(
                'SRC' => $arFileTmp["src"],
                'WIDTH' => $arFileTmp["width"],
                'HEIGHT' => $arFileTmp["height"],
        );
	}
endforeach;

$arResult["NAV_STRING"] = strtr($arResult["NAV_STRING"],["phppage-"=>"php/page-"]);