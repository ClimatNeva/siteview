<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("heading", "Акция на монтаж");
$APPLICATION->SetPageProperty("title", "Акция на монтаж");
$APPLICATION->SetPageProperty("keywords", "Акция на монтаж: Ключевые слова 2");
$APPLICATION->SetPageProperty("description", "Акция на монтаж: Описание 1");
$APPLICATION->SetTitle("Акция на монтаж");
$APPLICATION->AddChainItem("Акция на монтаж");
/*
?> 
<div class="col-md-3 col-sm-4 hidden-xs"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "left_menu_inc.php"
	)
);?> </div>
<div class="col-md-9 col-sm-8"> 
  <h1><?$APPLICATION->ShowTitle('heading');?></h1>
 */?>
 
  <div class="row"> 	
    <div class="col-xs-12"> 		
      <div class="bxr-section-desc"> 	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "montazh_inc.php"
	)
);?> 		</div>
     	</div>
   </div>
 
  <div class="row"> 	
	<div class="col-xs-12"> 	<?
	require_once ('montazh/main_block_inc.php');
	/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "main_block_inc.php"
	)
);*/?> 	</div>
   </div>
 
  <div style="clear: both;"></div>
<?// </div>
?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>