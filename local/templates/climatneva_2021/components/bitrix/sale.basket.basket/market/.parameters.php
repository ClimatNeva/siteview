<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (CModule::IncludeModule("catalog"))
{
	$arSKU = false;
	$boolSKU = false;
	$arOfferProps = array();

	// get iblock props from all catalog iblocks including sku iblocks
	$arSkuIblockIDs = array();
	$dbCatalog = CCatalog::GetList(array(), array());
	while ($arCatalog = $dbCatalog->GetNext())
	{
		$arSKU = CCatalogSKU::GetInfoByProductIBlock($arCatalog['IBLOCK_ID']);

		if (!empty($arSKU) && is_array($arSKU))
		{
			$arSkuIblockIDs[] = $arSKU["IBLOCK_ID"];
			$arSkuData[$arSKU["IBLOCK_ID"]] = $arSKU;

			$boolSKU = true;
		}
	}

	// iblock props
	$arProps = array();
	foreach ($arSkuIblockIDs as $iblockID)
	{
		$dbProps = CIBlockProperty::GetList(
			array(
				"SORT"=>"ASC",
				"NAME"=>"ASC"
			),
			array(
				"IBLOCK_ID" => $iblockID,
				"ACTIVE" => "Y",
				"CHECK_PERMISSIONS" => "N",
			)
		);

		while ($arProp = $dbProps->GetNext())
		{
			if ($arProp['ID'] == $arSkuData[$arSKU["IBLOCK_ID"]]["SKU_PROPERTY_ID"])
				continue;

			if ($arProp['XML_ID'] == 'CML2_LINK')
				continue;

			$strPropName = '['.$arProp['ID'].'] '.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];

			if ($arProp['PROPERTY_TYPE'] != 'F')
			{
				$arOfferProps[$arProp['CODE']] = $strPropName;
			}
		}

		if (!empty($arOfferProps) && is_array($arOfferProps))
		{
			$arTemplateParameters['OFFERS_PROPS'] = array(
				'PARENT' => 'OFFERS_PROPS',
				'NAME' => GetMessage('SALE_PROPERTIES_RECALCULATE_BASKET'),
				'TYPE' => 'LIST',
				'MULTIPLE' => 'Y',
				'SIZE' => '7',
				'ADDITIONAL_VALUES' => 'N',
				'REFRESH' => 'N',
				'DEFAULT' => '-',
				'VALUES' => $arOfferProps
			);
		}
	}
}

$arTemplateParameters['PRINT_ORDER'] = array(
    'PARENT' => 'ADDITIONAL_SETTINGS',
    'NAME' => GetMessage('PRINT_ORDER'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'Y'
);


$arTemplateParameters = array( 
    "GIFTS_TEXT_LABEL_GIFT" => Array( 
        "HIDDEN" => 'Y', 
    ), 
    "GIFTS_SHOW_OLD_PRICE" => Array( 
        "HIDDEN" => 'Y', 
    ), 
    "GIFTS_SHOW_DISCOUNT_PERCENT" => Array( 
        "HIDDEN" => 'Y', 
    ), 
    "GIFTS_SHOW_NAME" => Array( 
        "HIDDEN" => 'Y', 
    ), 
    "GIFTS_SHOW_IMAGE" => Array( 
        "HIDDEN" => 'Y', 
    ), 
    "GIFTS_CONVERT_CURRENCY" => Array( 
        "HIDDEN" => 'Y', 
    ),
    "GIFTS_PRODUCT_PROPS_VARIABLE" => Array(
        "HIDDEN" => 'Y',         
    )
);

?>