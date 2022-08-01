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

$hoverEffectFile = ($arParams['HOVER_EFFECT']) ? $arParams['HOVER_EFFECT'] : 'default';
$displayTypeClass = ($arParams['DISPLAY_TYPE']) ? $arParams['DISPLAY_TYPE'] : 'block';

?><div class="row bxr-promo-ribbon bxr-promo-<?=$displayTypeClass?>"><?
    foreach ($arResult['SECTIONS'] as $arItem):
        ?><div id="<?=$this->GetEditAreaId($arItem['ID']);?>" 
             class="bxr-promo-element col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?
                if (file_exists($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/include/'.$hoverEffectFile.'.php'))
                {
                    include ($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/include/'.$hoverEffectFile.'.php');
                }
                else
                {
                    include ($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/include/default.php');
                    $this->addExternalCss($this->GetFolder().'/include/css/default.css');
                    }
        ?></div><?
    endforeach;
?></div><?
// Include css
if (file_exists($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/include/css/'.$hoverEffectFile.'.css'))
	$this->addExternalCss($this->GetFolder().'/include/css/'.$hoverEffectFile.'.css');
else
	$this->addExternalCss($this->GetFolder().'/include/css/default.css');
?>
