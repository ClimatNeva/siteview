<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//echo "<pre>",print_r($arResult),"</pre>";

?><div class="uslugi"><?
if (!empty($arResult["SECTION"]["DESCRIPTION"])) {
	$arText = explode("#FORM#", $arResult["SECTION"]["~DESCRIPTION"]);
	if (!empty($arResult["SECTION"]["UF_SHOW_FORM"]) && $arResult["SECTION"]["UF_SHOW_FORM"] == true && sizeof($arText) > 1) {
		echo $arText[0];
		$APPLICATION->IncludeFile(SITE_DIR."include/uslugi/uslugi-form.php",[],["MODE"=>"php"]);
		echo $arText[1];
	} else {
		echo strtr($arResult["SECTION"]["DESCRIPTION"],["#FORM#"=>""]);
	}
}

if (!empty($arResult["SECTION"]["UF_SHOW_CNTBOX"])) {
	if (!empty($arResult["SECTION"]["UF_VIDEOFILE"])) {
		$videoFileLink = $arResult["SECTION"]["UF_VIDEOFILE"];
	}
	if (!empty($arResult["SECTION"]["UF_VIDEOPREVIEW"])) {
		$videoFilePreview = $arResult["SECTION"]["UF_VIDEOPREVIEW"];
	}
	require_once($_SERVER["DOCUMENT_ROOT"].'/include/uslugi/spektr.php');
}

if (!empty($arResult["SECTION"]["UF_SHOW_FORM"])) {
	//require_once($_SERVER["DOCUMENT_ROOT"].'/include/uslugi/zakaz-form.php');
}
?></div>
<script>
var pageName = "<?=$arResult["SECTION"]["NAME"];?>";
</script><?

