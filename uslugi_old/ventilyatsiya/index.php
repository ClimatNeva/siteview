<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вентиляция");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>