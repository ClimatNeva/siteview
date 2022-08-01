<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Проектирование и поставка кондиционеров для офисов, складов и коммерческих помещений. Инженерная и сервисная поддержка клиентов. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("keywords", "кондиционеры для офиса, кондиционеры для склада");
$APPLICATION->SetPageProperty("title", "Кондиционеры для офисов и коммерческих помещений в Санкт-Петербурге | Климат Нева ©");
$APPLICATION->SetTitle("Кондиционеры для офисов и коммерческих помещений");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>