<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH . '/js/owl.carousel.min.js');

$asset->addCss(SITE_TEMPLATE_PATH . '/css/owl.carousel.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/owl.theme.default.min.css');
