<?
$class = "12";
if (!empty($videoFileLink)) {
    $class = "6";
}
?><div class="row mt-30">
    <div class="col-xs-12 col-sm-12 col-md-<?=$class;?> col-lg-<?=$class;?>">
        <h2 class="full-spektr">Мы предоставляем полный спектр услуг по вентиляции квартир и частных домов</h2>
        <ol class="full-spektr-ol">
            <li>Подбор и расчет системы вентиляции</li>
            <li>Проектирование</li>
            <li>Поставка вентиляционного оборудования</li>
            <li>Монтаж</li>
            <li>Гарантийное и сервисное обслуживание</li>
            <li>Ремонт</li>
        </ol>
    </div><?
if (!empty($videoFileLink)) {
    CJSCore::RegisterExt(
        "mediaplayer", array(
            "js" => SITE_TEMPLATE_PATH."/js/mediaelement-and-player.min.js",
            "css" => SITE_TEMPLATE_PATH."/css/mediaelementplayer.min.css",
            "rel" => Array("jquery"),
            "skip_core" => true,
        )
    );
    CJSCore::Init(array('mediaplayer'));
    ?><div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <video id="player1" poster="<?=$videoFilePreview;?>" preload="none" controls playsinline webkit-playsinline>
            <source src="<?=$videoFileLink;?>" type="<?=$videoFileLink["TYPE"];?>">
        </video>
    </div><?
}
?></div>
