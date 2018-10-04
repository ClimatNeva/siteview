<?
$APPLICATION->SetPageProperty("keywords", "-");
?>
<? IncludeTemplateLangFile(__FILE__);?>

        </div>
    </div>
</div>


	<?if ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php'):?>

		<?if ($mainPageType == "one_col"):?>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"named_area",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => SITE_DIR."include/main_page_footer.php",
							"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_FOOTER")
						),
						false
					);?>
					</div>
				</div>
			</div>
		<?endif;?>

		<?$APPLICATION->IncludeComponent(
	"alexkova.market:catalog.brandblock", 
	"brand_slider", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "12",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"PROP_CODE" => array(
			0 => "",
			1 => "Manufacturer",
			2 => "",
		),
		"WIDTH" => "200",
		"HEIGHT" => "70",
		"WIDTH_SMALL" => "200",
		"HEIGHT_SMALL" => "70",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "brand_slider",
		"SHOW_DEACTIVATED" => "N",
		"SINGLE_COMPONENT" => "Y",
		"ELEMENT_COUNT" => "15",
		"BRAND_SHUFFLE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
	<?endif;?>


<?if (isset($BXReady)):?>
	<?$BXReady->showBannerPlace("BOTTOM");?>
<?endif;?>

    <footer>
        <div class="footer-line"></div>
        <div class="container footer-head hidden-sm hidden-xs">
            <div class="row">

                    <div class="col-lg-8 col-md-8 hidden-sm hidden-xs">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_catalog_name.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_CATALOG")
                            ),
                            false
                        );?>
                    </div>
                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_menu_name.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_MENU")
                            ),
                            false
                        );?>
                    </div>
                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs footer-socnet-col">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_socnet.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_SOCNET")
                            ),
                            false
                        );?>
                    </div>

            </div>
        </div>
        <div class="container">



            <div class="row footerline">

                    <div class="hidden-lg hidden-md col-sm-12 col-xs-12 mobile-footer-menu-tumbl">
                        <i class="fa fa-chevron-down"></i>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_catalog_name.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_CATALOG")
                            ),
                            false
                        );?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 toggled-item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "alexkova.market:menu",
                            "footer_cols",
                            Array(
                                "ROOT_MENU_TYPE" => "bottom_catalog",
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",   
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => "",
                                "COLS" => "4",
                            ),
                            false,
                            array('HIDE_ICONS'=>"Y")
                        );
                        ?>
                    </div>
                    <div class="hidden-lg hidden-md col-sm-12 col-xs-12 mobile-footer-menu-tumbl">
                        <i class="fa fa-chevron-down"></i>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_menu_name.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_MENU")
                            ),
                            false
                        );?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 toggled-item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "alexkova.market:menu",
                            "footer_cols",
                            Array(
                                "ROOT_MENU_TYPE" => "footer",
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",   
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => "",
                                "COLS" => "1",
                            ),
                            false
                        );
                        ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 footer-about-company">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_about_company.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_INFO")
                            ),
                            false
                        );?>
                    </div>
                    <div class="hidden-lg hidden-md col-sm-12 col-xs-12">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_socnet.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_SOCNET")
                            ),
                            false
                        );?>
                    </div>

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

    <link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
    <script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=4d109f08a98140aad5296c7d4b78087d" charset="UTF-8" async></script>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
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
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/tag.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks2");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/31317263" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
    </body>
</html>
