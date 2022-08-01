<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH . '/js/fileinput.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/imask.min.js');

