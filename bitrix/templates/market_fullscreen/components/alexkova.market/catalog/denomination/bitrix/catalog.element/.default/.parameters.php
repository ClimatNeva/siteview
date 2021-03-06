<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

if (!Loader::includeModule('iblock'))
	return;
$boolCatalog = Loader::includeModule('catalog');

$arSKU = false;
$boolSKU = false;
if ($boolCatalog && (isset($arCurrentValues['IBLOCK_ID']) && 0 < intval($arCurrentValues['IBLOCK_ID'])))
{
	$arSKU = CCatalogSKU::GetInfoByProductIBlock($arCurrentValues['IBLOCK_ID']);
	$boolSKU = !empty($arSKU) && is_array($arSKU);
}

/************* old parameters ******************/


if (isset($arCurrentValues['IBLOCK_ID']) && 0 < intval($arCurrentValues['IBLOCK_ID']))
{
	$arAllPropList = array();
	$arFilePropList = array(
		'-' => GetMessage('CP_BCE_TPL_PROP_EMPTY')
	);
	$arListPropList = array(
		'-' => GetMessage('CP_BCE_TPL_PROP_EMPTY')
	);
        $arHighloadPropList = array(
		'-' => GetMessage('CP_BCE_TPL_PROP_EMPTY')
	);
	$rsProps = CIBlockProperty::GetList(
		array('SORT' => 'ASC', 'ID' => 'ASC'),
		array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y')
	);
	while ($arProp = $rsProps->Fetch())
	{
		$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
		if ('' == $arProp['CODE'])
			$arProp['CODE'] = $arProp['ID'];
		$arAllPropList[$arProp['CODE']] = $strPropName;
		if ('F' == $arProp['PROPERTY_TYPE'])
			$arFilePropList[$arProp['CODE']] = $strPropName;
		if ('L' == $arProp['PROPERTY_TYPE'])
			$arListPropList[$arProp['CODE']] = $strPropName;
		if ('S' == $arProp['PROPERTY_TYPE'] && 'directory' == $arProp['USER_TYPE'] && CIBlockPriceTools::checkPropDirectory($arProp))
			$arHighloadPropList[$arProp['CODE']] = $strPropName;
	}

	$arTemplateParameters['ADD_PICT_PROP'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_ADD_PICT_PROP'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'ADDITIONAL_VALUES' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => '-',
		'VALUES' => $arFilePropList
	);

	$arTemplateParameters['LABEL_PROP'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_LABEL_PROP'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'ADDITIONAL_VALUES' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => '-',
		'VALUES' => $arListPropList
	);

	if ($boolSKU)
	{
		$arAllOfferPropList = array();
		$arFileOfferPropList = array(
			'-' => GetMessage('CP_BCE_TPL_PROP_EMPTY')
		);
		$arTreeOfferPropList = array(
			'-' => GetMessage('CP_BCE_TPL_PROP_EMPTY')
		);
		$rsProps = CIBlockProperty::GetList(
			array('SORT' => 'ASC', 'ID' => 'ASC'),
			array('IBLOCK_ID' => $arSKU['IBLOCK_ID'], 'ACTIVE' => 'Y')
		);
		while ($arProp = $rsProps->Fetch())
		{
			if ($arProp['ID'] == $arSKU['SKU_PROPERTY_ID'])
				continue;
			$arProp['USER_TYPE'] = (string)$arProp['USER_TYPE'];
			$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
			if ('' == $arProp['CODE'])
				$arProp['CODE'] = $arProp['ID'];
			$arAllOfferPropList[$arProp['CODE']] = $strPropName;
			if ('F' == $arProp['PROPERTY_TYPE'])
				$arFileOfferPropList[$arProp['CODE']] = $strPropName;
			if ('N' != $arProp['MULTIPLE'])
				continue;
			if (
				'L' == $arProp['PROPERTY_TYPE']
				|| 'E' == $arProp['PROPERTY_TYPE']
				|| ('S' == $arProp['PROPERTY_TYPE'] && 'directory' == $arProp['USER_TYPE'] && CIBlockPriceTools::checkPropDirectory($arProp))
			)
				$arTreeOfferPropList[$arProp['CODE']] = $strPropName;
		}
		$arTemplateParameters['OFFER_ADD_PICT_PROP'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BCE_TPL_OFFER_ADD_PICT_PROP'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => '-',
			'VALUES' => $arFileOfferPropList
		);
		$arTemplateParameters['OFFER_TREE_PROPS'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BCE_TPL_OFFER_TREE_PROPS'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => '-',
			'VALUES' => $arTreeOfferPropList
		);
	}
}

$arTemplateParameters['DISPLAY_NAME'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_DISPLAY_NAME'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y'
);

$detailPictMode = array(
	'IMG' => GetMessage('DETAIL_PICTURE_MODE_IMG'),
	'POPUP' => GetMessage('DETAIL_PICTURE_MODE_POPUP'),
	'MAGNIFIER' => GetMessage('DETAIL_PICTURE_MODE_MAGNIFIER')
);

$arTemplateParameters['DETAIL_PICTURE_MODE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_DETAIL_PICTURE_MODE'),
	'TYPE' => 'LIST',
	'DEFAULT' => 'IMG',
	'VALUES' => $detailPictMode
);

$arTemplateParameters['ADD_DETAIL_TO_SLIDER'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_ADD_DETAIL_TO_SLIDER'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N'
);

$displayPreviewTextMode = array(
	'H' => GetMessage('CP_BCE_TPL_DISPLAY_PREVIEW_TEXT_MODE_HIDE'),
	'E' => GetMessage('CP_BCE_TPL_DISPLAY_PREVIEW_TEXT_MODE_EMPTY_DETAIL'),
	'S' => GetMessage('CP_BCE_TPL_DISPLAY_PREVIEW_TEXT_MODE_SHOW')
);

$arTemplateParameters['DISPLAY_PREVIEW_TEXT_MODE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_DISPLAY_PREVIEW_TEXT_MODE'),
	'TYPE' => 'LIST',
	'VALUES' => $displayPreviewTextMode,
	'DEFAULT' => 'E'
);

$arTemplateParameters['HIDE_PREVIEW_PROPS_INLIST'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_HIDE_PREVIEW_PROPS_INLIST'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y'
);

if ($boolCatalog)
{
	$arTemplateParameters['PRODUCT_SUBSCRIPTION'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_PRODUCT_SUBSCRIPTION'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
	$arTemplateParameters['SHOW_DISCOUNT_PERCENT'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_SHOW_DISCOUNT_PERCENT'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
	$arTemplateParameters['SHOW_OLD_PRICE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_SHOW_OLD_PRICE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
	$arTemplateParameters['SHOW_MAX_QUANTITY'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_SHOW_MAX_QUANTITY'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);

	$arTemplateParameters['SHOW_AVAILABLE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_SHOW_AVAILABLE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
}

$arTemplateParameters['DISPLAY_COMPARE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_DISPLAY_COMPARE'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N'
);

$arTemplateParameters['MESS_BTN_BUY'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_MESS_BTN_BUY'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BCE_TPL_MESS_BTN_BUY_DEFAULT')
);
$arTemplateParameters['MESS_BTN_ADD_TO_BASKET'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_MESS_BTN_ADD_TO_BASKET'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BCE_TPL_MESS_BTN_ADD_TO_BASKET_DEFAULT')
);
$arTemplateParameters['MESS_BTN_SUBSCRIBE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_MESS_BTN_SUBSCRIBE'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BCE_TPL_MESS_BTN_SUBSCRIBE_DEFAULT')
);
if (isset($arCurrentValues['DISPLAY_COMPARE']) && 'Y' == isset($arCurrentValues['DISPLAY_COMPARE']))
{
	$arTemplateParameters['MESS_BTN_COMPARE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_MESS_BTN_COMPARE'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('CP_BCE_TPL_MESS_BTN_COMPARE_DEFAULT')
	);
}
$arTemplateParameters['MESS_NOT_AVAILABLE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_MESS_NOT_AVAILABLE'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BCE_TPL_MESS_NOT_AVAILABLE_DEFAULT')
);

$arTemplateParameters['USE_VOTE_RATING'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_USE_VOTE_RATING'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
	'REFRESH' => 'Y'
);
if (isset($arCurrentValues['USE_VOTE_RATING']) && 'Y' == $arCurrentValues['USE_VOTE_RATING'])
{
	$arTemplateParameters['VOTE_DISPLAY_AS_RATING'] = array(
		'NAME' => GetMessage('CP_BCE_TPL_VOTE_DISPLAY_AS_RATING'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'rating' => GetMessage('CP_BCE_TPL_VDAR_RATING'),
			'vote_avg' => GetMessage('CP_BCE_TPL_VDAR_AVERAGE'),
		),
		'DEFAULT' => 'rating'
	);
}

$arTemplateParameters['USE_COMMENTS'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_USE_COMMENTS'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
	'REFRESH' => 'Y'
);

if (isset($arCurrentValues['USE_COMMENTS']) && $arCurrentValues['USE_COMMENTS'] == 'Y')
{
	if (ModuleManager::isModuleInstalled("blog"))
	{
		$arTemplateParameters['BLOG_USE'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BCE_TPL_BLOG_USE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y'
		);

		if (isset($arCurrentValues['BLOG_USE']) && $arCurrentValues['BLOG_USE'] == 'Y')
		{
			$arTemplateParameters['BLOG_URL'] = array(
				'PARENT' => 'VISUAL',
				'NAME' => GetMessage('CP_BCE_TPL_BLOG_URL'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'catalog_comments'
			);
		}
	}

	$boolRus = false;
	$langBy = "id";
	$langOrder = "asc";
	$rsLangs = CLanguage::GetList($langBy, $langOrder, array('ID' => 'ru',"ACTIVE" => "Y"));
	if ($arLang = $rsLangs->Fetch())
	{
		$boolRus = true;
	}

	if ($boolRus)
	{
		$arTemplateParameters['VK_USE'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BCE_TPL_VK_USE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y'
		);

		if (isset($arCurrentValues['VK_USE']) && 'Y' == $arCurrentValues['VK_USE'])
		{
			$arTemplateParameters['VK_API_ID'] = array(
				'PARENT' => 'VISUAL',
				'NAME' => GetMessage('CP_BCE_TPL_VK_API_ID'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'API_ID'
			);
		}
	}

	$arTemplateParameters['FB_USE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_FB_USE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y'
	);

	if (isset($arCurrentValues['FB_USE']) && 'Y' == $arCurrentValues['FB_USE'])
	{
		$arTemplateParameters['FB_APP_ID'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BCE_TPL_FB_APP_ID'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		);
	}
}

if (ModuleManager::isModuleInstalled("highloadblock"))
{
	$arTemplateParameters['BRAND_USE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_BRAND_USE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y'
	);

	if (isset($arCurrentValues['BRAND_USE']) && 'Y' == $arCurrentValues['BRAND_USE'])
	{
		$arTemplateParameters['BRAND_PROP_CODE'] = array(
			'PARENT' => 'VISUAL',
			"NAME" => GetMessage("CP_BCE_TPL_BRAND_PROP_CODE"),
			"TYPE" => "LIST",
			"VALUES" => $arHighloadPropList
		);
	}
}

/** emarket **/
$arTemplateParameters['COMPARE_SCROLL_UP'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_COMPARE_SCROLL_UP'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
);


?>