<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Кондиционирование воздуха в жилых, коммерческих и промышленных помещениях Санкт-Петербурга и Ленинградской области. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Кондиционирование воздуха в Санкт-Петербурге | Климат Нева ");
$APPLICATION->SetTitle("Кондиционирование воздуха ");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>

<div class="row uslugi">
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
    </div>
    <div class="col-xs-12">
        <div class="vent-of-box">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Поставка и монтаж кондиционеров и вентиляции — основное направление деятельности нашей компании</h3>
                    <ul class="cond-icon">
                        <li>Более семи лет опыта</li>
                        <li>Персонал постоянно проходит обучение</li>
                        <li>Применяем в работе современные технологии</li>
                        <li>Индивидуальные техническое решение</li>
                    </ul>
                    <button class="cond-btn eqipment-btn bxr-color-button">Подобрать кондиционер</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <ul class="cond-boxes">
            <li><a href="/uslugi/konditsionery/dlya-doma-i-kvartiry/">Кондиционеры<br>для дома и квартиры</a></li>
            <li><a href="/uslugi/konditsionery/dlya-kafe-i-restoranov/">Кондиционеры<br>для ресторанов</a></li>
            <li><a href="/uslugi/konditsionery/dlya-ofisov-i-kommercheskikh-pomeshcheniy/">Кондиционеры<br>для офисов</a></li>
            <li><a href="/uslugi/konditsionery/dlya-ofisnykh-i-biznes-tsentrov/">Кондиционеры<br>для бизнес-центров</a></li>
        </ul>
    </div>
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-2') ?></div>
    </div>
    <div class="col-xs-12">
        <?
            include_once($_SERVER['DOCUMENT_ROOT'].'/uslugi/include/spektr.php');
        ?>
        <?
            include_once($_SERVER['DOCUMENT_ROOT'].'/uslugi/include/zakaz-form.php');
        ?>
    </div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>