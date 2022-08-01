<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="rev-slider">
        <div class="carousel slide" id="carousel" data-ride="carousel">
            <div class="carousel-inner">
<?
$counterSlider = true;
foreach ($arResult["ITEMS"] as $cnt=>$arItem) {
?>
        <div class="item<?
                if ($counterSlider) {
                    echo " active";
                    $counterSlider = false;
                }
                ?>">
            <div class="carousel-caption">
              <div class="col-md-4 hidden-sm hidden-xs">
                  <div class="carousel-bg" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>');"></div>
              </div>
              <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-0 rev-slider-inner" data-slidenum="<?=$arItem["ID"]?>">
                  <div class="rev-object">
                      <div class="rev-icon"><img src="<?=$arItem["DISPLAY_PROPERTIES"]["OBJ_ICON"]["FILE_VALUE"]["SRC"]?>"></div>
                      <div class="rev-obj-text">
                          <div class="rev-obj-text-name"><?=$arItem["DISPLAY_PROPERTIES"]["OBJ_NAME"]["VALUE"]?></div>
                          <div class="rev-obj-text-city"><?=$arItem["DISPLAY_PROPERTIES"]["CITY"]["VALUE"]?></div>
                      </div>
                  </div>
                  <div class="rev-text"><?if (strlen($arItem["PREVIEW_TEXT"])>250) {
					  echo TruncateText(preg_replace('!</*[divb ]+/*>!i','',$arItem["PREVIEW_TEXT"]),250)?>
                        <div class="review_read_more" data-slidenum="<?=$arItem["ID"]?>">Читать далее</div>
                    <?} else {
					echo preg_replace('!</*[divb ]+/*>!i','',$arItem["PREVIEW_TEXT"]);
                    } ?></div>
                  <div class="rev-text-full"><?=preg_replace('!div!i','p',$arItem["PREVIEW_TEXT"])?></div>
                  <div class="rev-author"><?=$arItem["NAME"]?></div>
                  <div class="rev-pos"><?=$arItem["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"]?></div>
                  <div class="rev-counts"><?=($cnt+1)?> / <?=sizeof($arResult["ITEMS"])?></div>
              </div>
            </div>
        </div>
<?
}
?>
    </div>
    <ol class="carousel-indicators">
<?
$counterSlider = true;
for ($i = 0; $i < sizeof($arResult["ITEMS"]); $i++) {?>
        <li <?
                if ($counterSlider) {
                    echo 'class="active" ';
                    $counterSlider = false;
                }
            ?>data-target="#carousel" data-slide-to="<?=$i;?>"></li>    
<?
}
?>
    </ol>
       <a href="#carousel" class="left carousel-control" data-slide="prev">
           <span class="slick-prev"></span>
        </a>
       <a href="#carousel" class="right carousel-control" data-slide="next">
           <span class="slick-next"></span>
        </a>
        </div>
</div>
