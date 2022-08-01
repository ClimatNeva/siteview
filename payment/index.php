<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Способы оплаты");
?>
    <div class="bxr-payment-block">
        <p class="pay-text">
            В Москве и Московской области вы можете <b>оплатить заказ при получении наличными или банковкой
                картой.</b>
            <br>
            Возможна <b>безналичная оплата</b>, для выставления счета необхдимо обратиться к нашему менеджеру.
            <br><br>
            Для <b>онлайн оплаты</b> на нашем сайте мы предлагаем множество вариантов:
        </p>
        <div class="pay-wrap">
            <div class="pay">
                <div class="pay-head">
                    <div class="pay-title">Банковские карты</div>
                </div>
                <div class="pay-desc">
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/visa.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/mastercard.png">
                    </div>
                </div>
            </div>
            <div class="pay">
                <div class="pay-head">
                    <div class="pay-title">Электронные деньги</div>
                </div>
                <div class="pay-desc">
                    
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/web_money.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/qiwi_wallet.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/dengi-mail.png">
                    </div>

                </div>
            </div>
            <div class="pay">
                <div class="pay-head">
                    <div class="pay-title">Терминалы моментальной оплаты</div>
                </div>
                <div class="pay-desc">
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/qiwi.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/elexnet.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/mobil-e.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/pinpay.png">
                    </div>
                </div>
            </div>
            <div class="pay">
                <div class="pay-head">
                    <div class="pay-title">Салоны связи</div>
                </div>
                <div class="pay-desc">
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/svyaznoy.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/evroset.png">
                    </div>
                </div>
            </div>
            <div class="pay">
                <div class="pay-head">
                    <div class="pay-title">Интернет банки</div>
                </div>
                <div class="pay-desc">
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/abank.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/vtb.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/petrocom.png">
                    </div>
                    <div class="pay-img">
                        <img src="<?=SITE_DIR?>images/payment/russtandart.png">
                    </div>
                </div>
            </div>
        </div>

        <p>
            <b>Обращаем Ваше внимание, что если Вы хотите оплатить заказ в терминале или салоне связи, то вначале
                необходимо получить счет, используя сервис Мои заказы на нашем сайте. При необходимости обращайтесь
                за помощью к нашим менеджерам.</b>
        </p>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

