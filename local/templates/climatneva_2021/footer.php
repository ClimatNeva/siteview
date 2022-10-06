<?
$APPLICATION->SetPageProperty("keywords", "-");
?>
<? IncludeTemplateLangFile(__FILE__);?>

        </div><?
if ($APPLICATION->GetCurPage(true) !== SITE_DIR.'index.php'):
    ?></div>
</div><?
endif;
?>

<footer>
    <div class="container">
        <div class="footer__top-row">
            <div class="footer__menu-col footer__menu-hide-xs">
                <div class="footer__menu-title"><?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_title_catalog.php",[],["MODE"=>"html"]);?></div>
                <ul class="footer__menu"><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "compact.menu",
                        array(
                            "ROOT_MENU_TYPE" => "footer_catalog",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "36000000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        ),
                        false
                    );
                ?></ul>
            </div>
            <div class="footer__menu-col footer__menu-hide-xs">
                <div class="footer__menu-title"><?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_title_company.php",[],["MODE"=>"html"]);?></div>
                <ul class="footer__menu"><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "compact.menu",
                        array(
                            "ROOT_MENU_TYPE" => "footer_company",
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
            <div class="footer__menu-col footer__menu-hide-xs">
                <div class="footer__menu-title"><?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_title_clients.php",[],["MODE"=>"html"]);?></div>
                <ul class="footer__menu"><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "compact.menu",
                        array(
                            "ROOT_MENU_TYPE" => "footer_clients",
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
            <div class="footer__menu-col">
                <div class="footer__address-box">
                    <div class="footer__phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_phone.php",[],["MODE"=>"html"]);?></div>
                    <div class="footer__mail"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_email.php",[],["MODE"=>"html"]);?></div>
                    <div class="footer__address"><?$APPLICATION->IncludeFile(SITE_DIR."include/index/index_address.php",[],["MODE"=>"html"]);?></div>
                    <div class="footer__socnets">
                        <a href="https://vk.com/climatneva" class="socnet" ref="nofollow" target="_blank"><img src="/img/svg/icon_vk_blue.svg" alt="Вконтакте" class="img-contain"></a>
                        <a href="https://www.facebook.com/groups/245953002526592/" class="socnet" ref="nofollow" target="_blank"><img src="/img/svg/icon_fb_blue.svg" alt="Facebook" class="img-contain"></a>
                        <a href="https://www.instagram.com/climatneva/" class="socnet" ref="nofollow" target="_blank"><img src="/img/svg/icon_inst_blue.svg" alt="Instagram" class="img-contain"></a>
                    </div>
                </div>
            </div>
            <div class="footer__menu-mobile">
                <ul class="footer__menu"><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "compact.menu",
                        array(
                            "ROOT_MENU_TYPE" => "footer_mobile",
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
        <div class="footer__bottom-row">
            <div class="footer__copyright"><?=date('Y');?> © <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_copyright.php",[],["MODE"=>"html"]);?></div>
            <a href="" class="footer__politics"><?$APPLICATION->IncludeFile(SITE_DIR."include/footer_confidental.php",[],["MODE"=>"html"]);?></a>
            <a href="" class="footer__agreement"><?$APPLICATION->IncludeFile(SITE_DIR."include/footer_agreement.php",[],["MODE"=>"html"]);?></a>
        </div>
    </div>
</footer>

    <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form");
        $formFrame->begin();?>
        <?$APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	".default",
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "10",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "47",
			1 => "48",
			2 => "49",
		),
		"NAME_FROM_PROPERTY" => "48",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "open-answer-form",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("RECALL_MESSAGE"),
		"SEND_EVENT" => "KZNC_NEW_FORM_PHONE_RESULT",
		"COMPONENT_TEMPLATE" => ".default",
		"PERSONAL_DATA" => "Y",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_CAPTION" => "Положение",
		"PERSONAL_DATA_URL" => "",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна.",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
        <?$formFrame->end();?>
        <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_request");
        $formFrame->begin();?>
        <?$APPLICATION->IncludeComponent(
                "alexkova.market:form.iblock",
                "request_trade",
                array(
                        "IBLOCK_TYPE" => "forms",
                        "IBLOCK_ID" => "11",
                        "STATUS_NEW" => "NEW",
                        "USE_CAPTCHA" => "N",
                        "USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
                        "RESIZE_IMAGES" => "N",
                        "MODE" => "link",
                        "PROPERTY_CODES" => array(
                                0 => "55",
                                1 => "56",
                                2 => "57",
                                3 => "58",
                                4 => "52",
                                5 => "51",
                                6 => "54",
                                7 => "53"
                        ),
                        "NAME_FROM_PROPERTY" => "57",
                        "GROUPS" => array(
                                0 => "2",
                        ),
                        "MAX_FILE_SIZE" => "0",
                        "EVENT_CLASS" => "bxr-trade-request",
                        "BUTTON_TEXT" => "",
                        "POPUP_TITLE" => GetMessage("REQUEST_TRADE"),
                        "SEND_EVENT" => "KZNC_NEW_FORM_REQUEST_RESULT",
                        "COMPONENT_TEMPLATE" => "request_trade"
                ),
                false
        );?>
        <?$formFrame->end();?>

        <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_one_click_buy");
        $formFrame->begin();?>
        <?$APPLICATION->IncludeComponent(
            "alexkova.market:form.iblock",
            "request_trade",
            array(
                    "IBLOCK_TYPE" => "forms",
                    "IBLOCK_ID" => "9",
                    "STATUS_NEW" => "NEW",
                    "USE_CAPTCHA" => "N",
                    "USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
                    "RESIZE_IMAGES" => "N",
                    "MODE" => "link",
                    "PROPERTY_CODES" => array(
						0 => "43",
						1 => "44",
						2 => "45",
						3 => "46",
						4 => "40",
						5 => "39",
						6 => "42",
						7 => "41"
                    ),
                    "NAME_FROM_PROPERTY" => "45",
                    "GROUPS" => array(
                            0 => "2",
                    ),
                    "MAX_FILE_SIZE" => "0",
                    "EVENT_CLASS" => "bxr-one-click-buy",
                    "BUTTON_TEXT" => "",
                    "POPUP_TITLE" => GetMessage("ONE_CLICK_FORM_TITLE"),
                    "SEND_EVENT" => "KZNC_NEW_FORM_CLICK_RESULT",
                    "COMPONENT_TEMPLATE" => "request_trade"
            ),
            false
        );
        $formFrame->end();?>

<?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_buy_cheaper");
        $formFrame->begin();?>
        <?$APPLICATION->IncludeComponent(
            "alexkova.market:form.iblock",
            "request_trade",
            array(
                    "IBLOCK_TYPE" => "forms",
                    "IBLOCK_ID" => "20",
                    "STATUS_NEW" => "NEW",
                    "USE_CAPTCHA" => "N",
                    "USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
                    "RESIZE_IMAGES" => "N",
                    "MODE" => "link",
                    "PROPERTY_CODES" => array(
						0 => "175",
						1 => "176",
						2 => "177",
						3 => "172",
						4 => "171",
						5 => "174",
						6 => "173"
                    ),
                    "NAME_FROM_PROPERTY" => "176",
                    "GROUPS" => array(
                            0 => "2",
                    ),
                    "MAX_FILE_SIZE" => "0",
                    "EVENT_CLASS" => "buy-cheaper",
                    "BUTTON_TEXT" => "",
                    "POPUP_TITLE" => GetMessage("CHEAPER_FORM_TITLE"),
                    "SEND_EVENT" => "KZNC_NEW_FORM_CLICK_RESULT",
                    "COMPONENT_TEMPLATE" => "request_trade"
            ),
            false
        );
        $formFrame->end();?>

        <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_get_object_sizes");
        $formFrame->begin();?>
		<?/**/?>
		<?$APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	"request_trade",
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "15",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "147",
			1 => "148",
			2 => "149",
			3 => "150",
			4 => "151",
		),
		"NAME_FROM_PROPERTY" => "149",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "bxr-get-object-sizes",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("ONE_CLICK_FORM_TITLE"),
		"SEND_EVENT" => "FORM_GET_OBJECT_SIZES",
		"COMPONENT_TEMPLATE" => "request_trade",
		"PERSONAL_DATA" => "Y",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_CAPTION" => "Положение",
		"PERSONAL_DATA_URL" => "",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна.",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

		<?$formFrame->end();?>
<script>
if (typeof docDelay === "undefined") docDelay = (document.documentElement.clientWidth < 768 ? 3000 : 0);

setTimeout(function(){
    $('.img-lazy').each(function(){
        if (typeof $(this).data('background') !== 'undefined')
            $(this).css('background','url('+$(this).data('background')+')');
    });
    $('.lazy').Lazy();
    <?
if ($MAINPAGE && !empty($unicumID)) {
?>
    $.ajax("/include/ajax_brandblock.php",{data: {'unucumID':<?=$unicumID;?>}}).success(function(data) {
        $('#brandblock').append(data);
        runSlider();
    })
<?
}
?>
}, docDelay);
</script>

<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script src="https://cdn.envybox.io/widget/cbk.js?wcb_code=4d109f08a98140aad5296c7d4b78087d" charset="UTF-8" async></script>

<!-- Yandex.Metrika counter -->
<script>
setTimeout(function(){
    $("head").append("<link rel='stylesheet' type='text/css' href='https://cdn.envybox.io/widget/cbk.css' />");
    $.getScript("https://cdn.envybox.io/widget/cbk.js?wcb_code=4d109f08a98140aad5296c7d4b78087d");

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
}, docDelay);
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/31317263" style="position:absolute; left:-9999px;" alt="yandex_watch" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
setTimeout(function(){
    $.getScript('https://stats.lptracker.ru/code/new/66217');
}, docDelay);
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143430440-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-143430440-1');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MP8M6KQ');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MP8M6KQ" class="google-noscript"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    </body>
</html>
