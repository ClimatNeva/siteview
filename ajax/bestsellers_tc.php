<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?if (isset($_SESSION["BXR_BESTSELLER_SETTINGS"]) && is_array($_SESSION["BXR_BESTSELLER_SETTINGS"])):
$arParams = $_SESSION["BXR_BESTSELLER_SETTINGS"];
	$APPLICATION->IncludeComponent(
		"alexkova.market:catalog.bestsellers",
		".default",
		$arParams,
		false
	);
endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>