           <div class="row mt-30">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h2 class="full-spektr">Мы предоставляем полный спектр услуг по вентиляции квартир и частных домов</h2>
                <ol class="full-spektr-ol">
                    <li>Подбор и расчет системы вентиляции</li>
                    <li>Проектирование</li>
                    <li>Поставка вентиляционного оборудования</li>
                    <li>Монтаж</li>
                    <li>Гарантийное и сервисное обслуживание</li>
                    <li>Ремонт</li>
                </ol>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><?
            if (empty($videoFileLink)) {
                ?><img class="no-video" src="/images/no-video.gif"><?
            } else {
                CJSCore::RegisterExt(
                    "mediaplayer", array(
                        "js" => SITE_TEMPLATE_PATH."/js/mediaelement-and-player.min.js",
                        "css" => SITE_TEMPLATE_PATH."/css/mediaelementplayer.min.css",
                        "rel" => Array("jquery"),
                        "skip_core" => true,
                    )
                );
                CJSCore::Init(array('mediaplayer'));
                ?><video id="player1" poster="<?=$videoFileLink["PREVIEW"];?>" preload="none" controls playsinline webkit-playsinline>
                    <source src="<?=$videoFileLink["LINK"];?>" type="<?=$videoFileLink["TYPE"];?>">
                </video><?
            }
            ?></div>
        </div>
