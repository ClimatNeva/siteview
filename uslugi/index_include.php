<div class="row uslugi">
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
    </div>
    <div class="col-xs-12"><?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "uslugi_index",
        Array(
            "VIEW_MODE" => "TEXT",
            "SHOW_PARENT_NAME" => "Y",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "22",
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_URL" => "",
            "COUNT_ELEMENTS" => "Y",
            "TOP_DEPTH" => "1",
            "SECTION_FIELDS" => "",
            "SECTION_USER_FIELDS" => array(),
            "ADD_SECTIONS_CHAIN" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y"
        ),
        false
    );
    ?>
        <?/*ul class="uslugi-box">
            <li><a href="/uslugi/konditsionery/">Кондиционирование</a></li>
            <li><a href="/uslugi/teplovoe-oborudovanie/">Тепловое оборудование</a></li>
            <li><a href="/uslugi/ventilyatsiya/">Системы вентиляции</a></li>
            <li><a href="/uslugi/uvlazhniteli-vozdukha/">Увлажнители воздуха</a></li>
            <li><a href="/uslugi/osushiteli/">Осушители воздуха</a></li>
            <li><a href="/uslugi/ochistiteli-vozdukha/">Очистители воздуха</a></li>
        </ul*/?>
    </div>
    <div class="col-xs-12">
        <h2>Как мы работаем</h2>
        <ol class="uslugi-counter-ol">
            <li>Проектирование</li>
            <li>Подбор и расчет</li>
            <li>Поставка оборудования</li>
            <li>Монтаж</li>
        </ol>
    </div>
    <div class="col-xs-12">
        <h2>Где мы работаем</h2>
        <div class="img-box"><img src="/images/uslugi/uslugi-map.jpg" alt="Где мы работаем"></div>
    </div>
</div>