<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Чистый воздух, очистители воздуха.");
$APPLICATION->SetPageProperty("description", "Большой ассортимент очистителей воздуха для квартир и офисных помещений. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Очистители воздуха в Санкт-Петербурге от компнаии Климат Нева");
$APPLICATION->SetTitle("Очистители воздуха");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div class="row uslugi">
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
    </div>
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-2') ?></div>
    </div>
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-3') ?></div>
    </div>
    <div class="col-xs-12">
        <div class="vent-of-box">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h3>При выборе воздухочистителя стоит учитывать следующие параметры</h3>
                    <ol class="full-spektr-ol">
                        <li>Принцип работы</li>
                        <li>Тип фильтрации</li>
                        <li>Уровень энергосбережения</li>
                        <li>Стоимость</li>
                    </ol>
                </div>
                <div class="ochist-box-img col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <img src="/images/ochistiteli/shema.jpg">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <h4 class="ochist-filtr-h4">Для людей страдающих аллергией и астмой главным фактором при выборе является тип фильтрации. По типу фильтрации различают:</h4>
        <div class="ochist-filter-row row">
            <div class="ochist-filter-col col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h4 class="icon1">Угольный фильтр</h4>
                <p>Уничтожает неприятные запахи. К сожалению, аллергикам такой принцип фильтрации не поможет, т.к. мелкая пыль и аллергены проходят через угольный фильтр.</p>
            </div>
            <div class="ochist-filter-col col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h4 class="icon2">Фотокалитический</h4>
                <p>Сочетание УФ-лучей и катализатора обеспечивает отличную чистку воздуха и избавляет от бактерий.</p>
            </div>
        </div>
        <div class="ochist-filter-row row">
            <div class="ochist-filter-col col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h4 class="icon3">Ультрафиолетовый</h4>
                <p>Приборы такого типа используются в больницах для дезинфекции. Да, бактерии уничтожаются, воздух становится стерильным, но длительное применение такого воздухоочистителя наносит ущерб здоровью.</p>
            </div>
            <div class="ochist-filter-col col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h4 class="icon4">Ультразвуковые</h4>
                <p>Надежная очистка и увлажнение воздуха, уничтожение аллергенов.</p>
            </div>
        </div>
        <div><? \BH\Frontend\Frontend::includeArea('index-4') ?></div>
    </div>
    <div class="col-xs-12">
        <?
            include_once($_SERVER['DOCUMENT_ROOT'].'/uslugi/include/zakaz-form.php');
        ?>
    </div>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>