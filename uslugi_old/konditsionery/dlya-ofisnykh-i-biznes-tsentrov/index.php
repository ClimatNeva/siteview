<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Проектирование и поставка систем кондиционирования для офисных  зданий и бизнес центров. Инженерная поддержка клиентов. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Кондиционеры для офисов и бизнес-центров в Санкт-Петербурге | Климат Нева ©");
$APPLICATION->SetTitle("Кондиционирование офисных и бизнес-центров");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>