<?IncludeTemplateLangFile(__FILE__);?>
<?
if (!CModule::IncludeModule('alexkova.market')) return;
if (!CModule::IncludeModule('alexkova.bxready')) return;

use Alexkova\Market\Core;
use Alexkova\Bxready\Core as BXRCore;
use Alexkova\Bxready\Bxready;

global $templateType, $catalogType, $mainPageType, $arTopMenu, $arLeftMenu;

$arTopMenu = array (
	"TYPE" => "with_catalog",
	"TEMPLATE" => "version_v1",
	"FIXED_MENU" => "Y",
	"FULL_WIDTH" => "Y",
	"STYLE_MENU" => "colored_dark",
	"TEMPLATE_MENU_HOVER" => "list",
	"STYLE_MENU_HOVER" => "colored_light",
	"PICTURE_SECTION" => "IMG",
	"PICTURE_CATEGARIES" => "N",
	"HOVER_MENU_COL_LG" => "3",
	"HOVER_MENU_COL_MD" => "3",
        "SEARCH_FORM" => "Y"
);

$arLeftMenu = array (
	"TYPE" => "only_catalog",
	"LEFT_MENU_TEMPLATE" => "left_hover",
	"STYLE_MENU" => "colored_light",
	"PICTURE_SECTION" => "N",
	"SUBMENU" => "ACTIVE_SHOW",
        "HOVER_TEMPLATE" => "classic",
        "STYLE_MENU_HOVER" => "colored_light",
        "PICTURE_SECTION_HOVER" => "N",
        "PICTURE_CATEGARIES" => "N",
        "HOVER_MENU_COL_LG" => "2",
        "HOVER_MENU_COL_MD" => "2"

);

$BXReady = \Alexkova\Market\Core::getInstance();
/******************default settings************************/
$BXReady->setAreaType('top_line_type', 'v21');
$BXReady->setAreaType('header_type', 'version_6');
$BXReady->setAreaType('top_menu_type', 'v1');
$BXReady->setAreaType('left_menu_type', 'v2');

$BXReady->setBannerSettings(array(
	"TOP"=>"FIXED",
	"BOTTOM"=>"FIXED",
	"CATALOG_TOP"=>"RESPONSIVE",
	"CATALOG_BOTTOM"=>"RESPONSIVE",
	"LEFT"=>"RESPONSIVE",
));

if ($USER->IsAdmin()) $BXReady->getBitrixTopPanelMenu();

$MAINPAGE = false;
if ($APPLICATION->GetCurPage(false) === '/') $MAINPAGE = true;

$mainPageType = "one_col";
//$mainPageType = "two_col";
if (!isset($GLOBALS["templateType"]) || $GLOBALS["templateType"]=='')
    $templateType = "two_col";
//$templateType = "one_col";
$catalogType = "two_col";
?>
<!DOCTYPE html>
<html lang=ru>
<head>

	<title><?$APPLICATION->ShowTitle();?></title>
	<link rel="preload" href="/bitrix/fonts/fontawesome-webfont.woff2?v=4.3.0" as="font" type="font/woff2" crossorigin="anonymous"><?
	/* ?><link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic&display=swap&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'><? */
	?><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<?/*meta name="yandex-verification" content="288089c641c16390" */?>
	<meta name="yandex-verification" content="3579424196149ea2" />
	<meta name="google-site-verification" content="Y2Y89iv0cM3SeG1EEMD3P8wz2zVsfr0zjHYzC-Hzb_k" />
    <script data-skip-moving="true"><?
    ?>var docDelay = window.innerWidth < 768 ? 5000 : 0;<?
    ?>var domReadyQueue = [];<?
    ?></script><?
	$APPLICATION->ShowHead();

	$asset = \Bitrix\Main\Page\Asset::getInstance();
	$asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery-1.11.3.min.js');
	$asset->addJs(SITE_TEMPLATE_PATH . '/js/script.js');

	$asset->addCss('/bitrix/css/main/font-awesome.css');
	$asset->addCss(SITE_TEMPLATE_PATH . '/library/bootstrap/css/grid10_column.min.css');
	$asset->addCss("/bitrix/css/main/bootstrap.css");
	$asset->addCss(SITE_TEMPLATE_PATH . '/library/less/less.css');
	$asset->addCss(SITE_TEMPLATE_PATH . '/css/base.css');
	$asset->addCss(SITE_TEMPLATE_PATH . '/css/common.css');
	
	$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"named_area",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/schema_og.php"
		),
		false
	);
	?><link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff"><?

	if (!$MAINPAGE) {
    $asset->addJs(SITE_TEMPLATE_PATH . '/library/bootstrap/js/bootstrap.min.js');
    CJSCore::RegisterExt(
      "lazy", array(
        "js" => SITE_TEMPLATE_PATH."/js/jquery.lazy.min.js",
        "rel" => Array(""),
        "skip_core" => true,
      )
    );
		CJSCore::RegisterExt(
			"fancybox_core", array(
				"js" => SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.pack.js",
				"css" => SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.min.css",
				"rel" => Array(""),
				"skip_core" => true,
			)
		);
		CJSCore::RegisterExt(
			"fancybox", array(
				"js" => SITE_TEMPLATE_PATH."/js/fancybox/helpers/jquery.fancybox-buttons.min.js",
				"css" => SITE_TEMPLATE_PATH."/js/fancybox/helpers/jquery.fancybox-buttons.min.css",
				"rel" => Array("fancybox_core"),
				"skip_core" => true,
			)
		);
		CJSCore::Init(array('fancybox', 'lazy'));
	}
	
?>
<!-- Yandex.Metrika counter -->
<script data-skip-moving="true">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter31317263 = new Ya.Metrika2({
                id:31317263,
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
            });
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "";
    s.async = true;
    s.src = "https://mc.yandex.ru/metrika/tag.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks2");
</script>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script data-skip-moving="true" async src="https://www.googletagmanager.com/gtag/js?id=UA-143430440-1"></script>
<script data-skip-moving="true">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-143430440-1');
</script>
<!-- Google Tag Manager -->
<script data-skip-moving="true">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MP8M6KQ');</script>
<!-- End Google Tag Manager -->
</head>
<body>
    <div id="panel"><?$APPLICATION->ShowPanel();?></div><?
	$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"named_area",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/schema.php"
		),
		false
	);

	$APPLICATION->IncludeComponent(
		"alexkova.market:buttonUp",
		".default",
		array(
			"COMPONENT_TEMPLATE" => ".default",
			"LOCATION_HORIZONTALLY" => "rigth",
			"BUTTON_UP_HORIZONTALLY_INDENT" => "15",
			"BUTTON_UP_VERTICAL_INDENT" => "15",
			"BUTTON_UP_TOP_SHOW" => "300",
			"BUTTON_UP_SPEED" => "5000"
		),
		false
	);

?><div class="mobile_header">
    <div class="mobile_inner">
        <div class="mobile_inner__row">
            <div class="mobile_close icon_close"></div>
        </div>
        <div class="mobile_inner__row"><?
			$APPLICATION->IncludeComponent(
				"bitrix:system.auth.form",
				"mobile.menu",
				array(
					"REGISTER_URL" => SITE_DIR."auth/",
					"FORGOT_PASSWORD_URL" => SITE_DIR."auth/",
					"PROFILE_URL" => SITE_DIR."personal/profile/",
					"SHOW_ERRORS" => "Y",
					"COMPONENT_TEMPLATE" => "mobile.menu"
				),
				false
			);
		?></div>
        <div class="mobile_inner__row"><?
			$APPLICATION->IncludeComponent(
				"alexkova.market:basket.small",
				"favor.mobile",
				array(
					"COMPONENT_TEMPLATE" => "favor.mobile",
					"PATH_TO_BASKET" => SITE_DIR."personal/basket/",
					"PATH_TO_ORDER" => SITE_DIR."personal/order/",
					"USE_COMPARE" => "Y",
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "12",
					"USE_DELAY" => "Y"
				),
				false
			);
		?></div>
        <div class="mobile_inner__row"><?
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.compare.list",
                "compare.mobile",
                Array(
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "12",
                    "POSITION_FIXED" => "Y",
                    "POSITION" => "top left",
                    "DETAIL_URL" => "",
                    "COMPARE_URL" => "compare.php",
                    "NAME" => "CATALOG_COMPARE_LIST",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id"
                )
            );
		?></div>
		<ul class="mobile_menu"><?
		$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"compact.menu",
			Array(
				"ROOT_MENU_TYPE" => "top_mobile",
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "N",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_TIME" => "36000000",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => ""
			),
			false
		);
		?></ul>
    </div>
</div>

<header>
    <div class="head__wrapper">
        <div class="head_mobile">
            <div class="head_mobile__opener"></div>
            <div class="head_mobile__logo"><?
                /* ?><img src="/img/png/logo_cn_black.png" alt="Климат Нева" width="130" height="37" class="head__logo-img"><? */
                    htmlTools::drawPictureTagWithWebp(
                [["SRC" => "/img/png/logo_cn_black.png"]],
                [
                  "itemName" => "Климат Нева",
                  "widthSets" => [["width" => 102, "height" => 29]],
                  "create_destination" => true,
                  "webp" => 50,
                ]);
            ?></div>
            <div class="head_mobile__search"></div>
            <a class="head_mobile__call" href="tel:+78126424020"></a>
			<a href="/personal/basket/" class="head_mobile__cart"><?
				$APPLICATION->IncludeComponent(
					"alexkova.market:basket.small",
					"cart.mobile",
					array(
						"COMPONENT_TEMPLATE" => "cart.mobile",
						"PATH_TO_BASKET" => SITE_DIR."personal/basket/",
						"PATH_TO_ORDER" => SITE_DIR."personal/order/",
						"USE_COMPARE" => "Y",
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "12",
						"USE_DELAY" => "Y"
					),
					false
				);
			?></a>
        </div>
        <div class="head__top-row">
            <div class="container">
				<ul class="head__top-left-menu"><?
				$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"compact.menu",
					Array(
						"ROOT_MENU_TYPE" => "top_left",
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => ""
					),
					false
				);
				?></ul>
				<ul class="head__top-right"><?
				$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form",
					"top.menu",
					array(
						"REGISTER_URL" => SITE_DIR."auth/",
						"FORGOT_PASSWORD_URL" => SITE_DIR."auth/",
						"PROFILE_URL" => SITE_DIR."personal/profile/",
						"SHOW_ERRORS" => "Y",
						"COMPONENT_TEMPLATE" => "top.menu"
					),
					false
				);
				?></ul>
            </div>
        </div>
        <div class="head__second-row">
            <div class="container"><?
				if ($MAINPAGE) {
					?><div class="head__logo"><?
				} else {
					?><a href="/" class="head__logo"><?
				}
                    /* ?><img src="/img/png/logo_cn_black.png" width="130" height="37" alt="Климат Нева" class="head__logo-img"><? */
                    htmlTools::drawPictureTagWithWebp(
                      [["SRC" => "/img/png/logo_cn_black.png"]],
                      [
                        "itemName" => "Климат Нева",
                        "widthSets" => [["width" => 130, "height" => 37]],
                        "create_destination" => true,
                        "webp" => 50,
                      ]);
				if ($MAINPAGE) {
					?></div><?
				} else {
					?></a><?
				}
                ?><div class="head__motto"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_slogan.php",[],["MODE"=>"html"]);?></div>
                <ul class="head__address-box">
                    <li class="head__icon icon-map"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_address.php",[],["MODE"=>"html"]);?></li>
                    <li class="head__icon icon-whatsapp"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_whatsapp.php",[],["MODE"=>"html"]);?></li>
                </ul>
                <div class="head__phone-box">
                    <div class="head__phone-link"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_phone.php",[],["MODE"=>"html"]);?></div>
                    <div class="head__phone-btn callback open-answer-form"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_callback.php",[],["MODE"=>"html"]);?></div>
                </div>
            </div>
        </div>
        <div class="head__bottom-row">
            <div class="container">
				<ul class="head__bottom-menu"><?
				$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"compact.menu",
					Array(
						"ROOT_MENU_TYPE" => "top_bottom",
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => ""
					),
					false
				);
				?></ul>
                <div class="head__search-box"><?
					$APPLICATION->IncludeComponent(
						"bitrix:search.title",
						"top.search",
						array(
							"NUM_CATEGORIES" => "3",
							"TOP_COUNT" => "10",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => SITE_DIR."search/",
							"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
							"CATEGORY_0" => array(
								0 => "iblock_catalog",
							),
							"CATEGORY_0_iblock_catalog" => array(
								0 => "12",
							),
							"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "search",
							"PRICE_CODE" => array(
							),
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y",
							"COMPONENT_TEMPLATE" => "top.search",
							"ORDER" => "rank",
							"USE_LANGUAGE_GUESS" => "N",
							"PRICE_VAT_INCLUDE" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "",
							"CURRENCY_ID" => "RUB"
						),
						false
					);
				?></div>
				<div class="head__bottom-right bxr-basket-row"><?
					/*$APPLICATION->IncludeComponent(
						"alexkova.market:basket.small",
						"main.cart",
						array(
							"COMPONENT_TEMPLATE" => "main.cart",
							"PATH_TO_BASKET" => SITE_DIR."personal/basket/",
							"PATH_TO_ORDER" => SITE_DIR."personal/order/",
							"PATH_TO_COMPARE" => SITE_DIR."catalog/compare.php",
							"PATH_TO_FAVOR" => SITE_DIR."favor/",
							"USE_COMPARE" => "Y",
							"IBLOCK_TYPE" => "catalog",
							"IBLOCK_ID" => "12",
							"USE_DELAY" => "Y"
						),
						false
					);*/
					$APPLICATION->IncludeComponent(
						"alexkova.market:basket.small",
						"cn.header",
						array(
							"COMPONENT_TEMPLATE" => "cn.header",
							"PATH_TO_BASKET" => SITE_DIR."personal/basket/",
							"PATH_TO_ORDER" => SITE_DIR."personal/order/",
							"USE_COMPARE" => "Y",
							"IBLOCK_TYPE" => "catalog",
							"IBLOCK_ID" => "12",
							"USE_DELAY" => "Y"
						),
						false
					);
				?></div>
            </div>
        </div>
    </div>
</header><?
	if ($APPLICATION->GetCurPage(true) != SITE_DIR.'index.php'):
	?><div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"climat-neva",
					Array(
						"COMPONENT_TEMPLATE" => "climat-neva",
						"PATH" => "",
						"SITE_ID" => "-",
						"START_FROM" => "0"
					)
				);?>


			</div>
		</div>
	</div>
    <?endif;?>

    <?if ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php' && $mainPageType != "two_col"):/*
        $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "named_area",
                Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_DIR."include/main_page_promo_slider.php",
                        "INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_PROMO_SLIDER")
                ),
                false
        );*/
	endif;
	
	if ($APPLICATION->GetCurPage(true) !== SITE_DIR.'index.php'):
	?><div class="container <?if ($mainPageType == "two_col" || $APPLICATION->GetCurPage(true) != SITE_DIR.'index.php') echo "tb20"; ?>" id="content">
		<div class="row"><?
	endif;
		
	if ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php'):

		$APPLICATION->IncludeFile(SITE_DIR."include/index/index_top.php",[],["MODE"=>"html"]);
			/*if ($mainPageType == "two_col"):?>
			<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/main_page_left_column.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_LEFT")
					),
					false
				);?>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/main_page_promo_column.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_PROMO")
					),
					false
				);?>
		<?else:?>
			<div class="col-xs-12">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/main_page_promo.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_PROMO")
					),
					false
				);?>
		<?endif;*/?>
	<?endif;?>

	<?if ($APPLICATION->GetCurPage(true) != SITE_DIR.'index.php'):?>
		<?if ($templateType == "one_col" || substr($APPLICATION->GetCurDir(),0,(8+strlen(SITE_DIR))) == SITE_DIR.'catalog/'):?>
				<div class="col-xs-12">
		<?else:?>
					<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"named_area",
							Array(
								"AREA_FILE_SHOW" => "sect",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => SITE_DIR."include/page_left_column.php",
								"INCLUDE_PTITLE" => GetMessage("GHANGE_PAGE_LEFT")
							),
							false
						);?>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
					<h1><?$APPLICATION->ShowTitle('heading');?></h1>
		<?endif;?>
	<?endif;?>