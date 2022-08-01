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

//echo "<pre>",print_r($arParams),"</pre>";
//echo "<pre>",print_r($arResult),"</pre>";

if (!empty($arResult["SECTIONS"])) {
	?><ul class="uslugi-box"><?
	foreach($arResult["SECTIONS"] as $section) {
		?><li style="background-image:url('<?=$section["PICTURE"]["SRC"];?>');'"><a href="<?=$section["SECTION_PAGE_URL"];?>"><?=$section["NAME"];?></a></li><?
	}
	?></ul><?
}
?>
