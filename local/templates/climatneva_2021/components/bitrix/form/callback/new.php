<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/script-uslugi.js');
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "",
    $arParams,
    $component
);?>