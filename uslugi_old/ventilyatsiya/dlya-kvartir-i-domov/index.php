<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Проектирование, поставка и монтаж систем вентиляции для квартир и частных домов в Санкт-Петербурге. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Вентиляция для квартир и частных домов в Санкт-Петербурге | Климат Нева");
$APPLICATION->SetTitle("Для квартир и домов");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div class="row uslugi">
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
        <div class="vent-home-fan">
            <? \BH\Frontend\Frontend::includeArea('index-2') ?>
        </div>
        <div><? \BH\Frontend\Frontend::includeArea('index-3') ?></div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="vent-grey-box">
                    <div class="img-box" style="background-image:url('/images/vent/vent-home-1.jpg')"></div>
                    <div class="text-box">
                        <h3>Для небольших квартир</h3>
                        <ul>
                            <li><a href="/catalog/kompaktnye-pritochnye-ustanovki/">Компактные приточные установки</a></li>
                            <li><a href="/catalog/provetrivateli/">Бризеры</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="vent-grey-box">
                    <div class="img-box" style="background-image:url('/images/vent/vent-home-2.jpg')"></div>
                    <div class="text-box">
                        <h3>Для больших квартир</h3>
                        <ul>
                            <li><a href="#">Приточные системы</a></li>
                            <li><a href="#">Приточно-вытяжные системы с сетью воздуховодов</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="vent-grey-box">
                    <div class="img-box" style="background-image:url('/images/vent/vent-home-3.jpg')"></div>
                    <div class="text-box">
                        <h3>Для загородных домов</h3>
                        <ul>
                            <li><a href="#">Приточно-вытяжные системы вентиляции с рекуперацией тепла</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?
            $videoFileLink = [
                "LINK" => '/upload/video/Komfovent-%20зачем%20нужна%20вентиляция.mp4',
                "TYPE" => "video/mp4",
                "PREVIEW" => '/upload/video/Komfovent-%20зачем%20нужна%20вентиляция.jpg'
            ];
            include_once($_SERVER['DOCUMENT_ROOT'].'/uslugi/include/spektr.php');
        ?>
        <?
            include_once($_SERVER['DOCUMENT_ROOT'].'/uslugi/include/zakaz-form.php');
        ?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>