<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

//echo "<pre>",print_r($arParams),"</pre>";

$arFilter = '';
$arFilter = array(array("name" => "sharpen", "precision" => 100));

foreach($arResult["ITEMS"] as $key => $arItem):
	if(is_array($arItem["PREVIEW_PICTURE"]))
	{
		//$mult = max($arItem["PREVIEW_PICTURE"]["WIDTH"]/220, $arItem["PREVIEW_PICTURE"]["HEIGHT"]/165);
        $arFileTmp = CFile::ResizeImageGet(
                $arItem["PREVIEW_PICTURE"],
                //array("width" => $arItem["PREVIEW_PICTURE"]["WIDTH"]/$mult, "height" => $arItem["PREVIEW_PICTURE"]["HEIGHT"]/$mult),
                array("width" => 220, "height" => 165),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true, $arFilter
        );
        $arResult["ITEMS"][$key]['PREVIEW_PICTURE_SMALL'] = array(
                'SRC' => $arFileTmp["src"],
                'WIDTH' => $arFileTmp["width"],
                'HEIGHT' => $arFileTmp["height"],
        );
	}
endforeach;
