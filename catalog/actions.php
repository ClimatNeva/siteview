<?
use \Bitrix\Main\Data\Cache;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Каталог | Кондиционеры, вентиляция и камины с установкой в Санкт-Петербурге. Бесплатный выезд специалистов. Доставка и монтаж. ☎ Звоните: 8 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Каталог | Кондиционеры и вентиляция в Санкт-Петербурге. Цены, доставка, монтаж");
$APPLICATION->SetTitle("Акция на монтаж");
$APPLICATION->AddChainItem("Акция на монтаж");

/*$timeSeconds = 0;
$cacheId = "actionsFilter";
$obCache = new CPHPCache();
$cachePath = '/'.SITE_ID.'/'.$cacheId;
if ($obCache->InitCache($timeSeconds, $cacheId, $cachePath)) {
	$vars = $obCache->GetVars();
}*/

$cache = Cache::createInstance();
if ($cache->initCache(7200, "actionsFilter")) {
    $actionsFilter = $cache->getVars(); // достаем переменные из кеша
} elseif ($cache->startDataCache()) {
    $actionsFilter = [];
    $arID = [];
	CModule::IncludeModule('iblock');
	$res = CIBlockElement::GetList(["SORT" => "asc"], ["IBLOCK_ID" => "12", "ACTIVE" => "Y", "!PROPERTY_AKCIY_MONTAZH" => false], false, false, ["ID", "IBLOCK_ID"]);
	while ($row = $res->GetNext()) {
        $arID[] = $row["ID"];
    }
	/*$res = \Bitrix\Iblock\Elements\ElementCatalogTable::getList(array(
	//$res = ElementTable::getList(array(
        'select' => ['ID', 'IBLOCK_ID'],
		'filter' => ['IBLOCK_ID' => 12, '!AKCIY_MONTAZH.VALUE' => false, 'ACTIVE' => 'Y'],
        'cache' => array(
            'ttl' => 60,
            'cache_joins' => true,
        )
    ));
    while ($row = $res->fetch()) {
        $arID[] = $row["ID"];
    }*/
    $actionsFilter['arID'] = $arID;
    $cache->endDataCache($actionsFilter); // записываем в кеш
}


global $globalElementsFilter;
$globalElementsFilter = array(
    /*">PROPERTY_MINIMUM_PRICE" => 0,*/
    "PROPERTY_MOUNT_COST" => $actionsFilter['arID']
);
//echo "<pre>",print_r($globalElementsFilter),"</pre>";
//echo "<pre>",print_r($actionsFilter),"</pre>";


?><div class="col-md-3 col-sm-4 hidden-xs"><?
$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "left_menu_inc.php"
	)
);?></div>
<div class="col-md-9 col-sm-8"> 
  <h1><?$APPLICATION->ShowTitle('heading');?></h1>
 
  <div class="row"> 	 
    <div class="col-xs-12"> 		 
      <div class="bxr-section-desc"><?
	  $APPLICATION->IncludeFile(
		SITE_DIR."catalog/actions/actions_inc.php",
		Array(),
		Array("MODE"=>"html")
	);
	/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "actions_inc.php"
	)
	);*/?></div>
     	</div>
   </div>
 
  <div class="row"> 	 
    <div class="col-xs-12"><?
	  $APPLICATION->IncludeFile(
		SITE_DIR."catalog/actions/main_block_inc.php",
		Array(),
		Array("MODE"=>"php")
	);
	/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "main_block_inc.php"
	)
	);*/?></div>
   </div>
 
  <div style="clear: both;"></div>
</div>
<?


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");