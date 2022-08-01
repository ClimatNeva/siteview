        <div class="row mt-30 callback-box" id="equipment-callback">
            <div class="col-xs-12">
                <h3>Заказать или подобрать оборудование вы можете по телефону (812) 642-40-20</h3>
                <p>Также вы можете заполнить форму и наши специалисты перезвонят вам.</p>
            </div>
            <div class="col-xs-12">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:form",
                    "callback",
                    Array(
                        "AJAX_MODE" => "N",
                        "SEF_MODE" => "N",
                        "WEB_FORM_ID" => "3",
                        "RESULT_ID" => $_REQUEST[RESULT_ID],
                        "START_PAGE" => "new",
                        "SHOW_LIST_PAGE" => "N",
                        "SHOW_EDIT_PAGE" => "N",
                        "SHOW_VIEW_PAGE" => "N",
                        "SUCCESS_URL" => "",
                        "SHOW_ANSWER_VALUE" => "N",
                        "SHOW_ADDITIONAL" => "N",
                        "SHOW_STATUS" => "Y",
                        "EDIT_ADDITIONAL" => "N",
                        "EDIT_STATUS" => "Y",
                        "NOT_SHOW_FILTER" => array(),
                        "NOT_SHOW_TABLE" => array(),
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => "",
                        "IGNORE_CUSTOM_TEMPLATE" => "Y",
                        "USE_EXTENDED_ERRORS" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "VARIABLE_ALIASES" => Array(
                            "action" => "action"
                        )
                    ),
                false
                );?>
            </div>
        </div>
