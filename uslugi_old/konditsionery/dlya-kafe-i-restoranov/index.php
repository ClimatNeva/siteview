<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Подбор, проектирование и монтаж кондиционеров в кафе и ресторанах. Инженерная и сервисная поддержка заказчиков. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("keywords", "кондиционеры для кафе, кондиционеры в рестораны");
$APPLICATION->SetPageProperty("title", "Кондиционеры для кафе и ресторанов в Санкт-Петербурге | Климат Нева ©");
$APPLICATION->SetTitle("Кондиционеры для кафе и ресторанов");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>