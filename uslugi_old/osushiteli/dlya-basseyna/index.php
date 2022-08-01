<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Поставка и монтаж осушителей воздуха для  малых и больших бассейнов  в Санкт-Петербурге и области. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Осушители воздуха для бассейнов в Санкт-Петербурге | Климат Нева");
$APPLICATION->SetTitle("Осушение воздуха");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div class="row uslugi">
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-1') ?></div>
    </div>
    <div class="col-xs-12">
        <div class="vent-of-box osush-box">
            <div><? \BH\Frontend\Frontend::includeArea('index-2') ?></div>
        </div>
    </div>
    <div class="col-xs-12">
        <h2 class="osush-h2"><? \BH\Frontend\Frontend::includeArea('index-3') ?></h2>
    </div>
    <div class="col-xs-12">
        <div class="osush-grey-box">
            <div class="osush-grey-box-img osush-grey-box-pic1"></div>
            <div class="osush-grey-box-cont">
                <? \BH\Frontend\Frontend::includeArea('index-4') ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-5') ?></div>
    </div>
    <div class="col-xs-12">
        <div class="osush-grey-box">
            <div class="osush-grey-box-img osush-grey-box-pic2"></div>
            <div class="osush-grey-box-cont">
                <? \BH\Frontend\Frontend::includeArea('index-6') ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-7') ?></div>
    </div>
    <div class="col-xs-12">
        <div class="osush-grey-box">
            <div class="osush-grey-box-img osush-grey-box-pic3"></div>
            <div class="osush-grey-box-cont">
                <? \BH\Frontend\Frontend::includeArea('index-8') ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div><? \BH\Frontend\Frontend::includeArea('index-9') ?></div>
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