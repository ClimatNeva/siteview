<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetPageProperty("heading", "Дизайнерские кондиционеры");
$APPLICATION->SetPageProperty("title", "Купить дизайнерский кондциицонер в Санкт-Петербурге | Климат Нева");
$APPLICATION->SetPageProperty("description", "Дизайнерские кондиционеры для квартиры и дома по низким ценам. Подбор оборудования и бесплатная доставка. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetTitle("Дизайнерские кондиционеры");
$APPLICATION->AddChainItem("Дизайнерские кондиционеры");

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
 
  <div class="row"> 	 
    <div class="col-xs-12"> 		 
      <div class="bxr-section-desc"> 	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "design_inc.php"
	)
);?> 		</div>
     	</div>
   </div>
 
  <div class="row"> 	 
    <div class="col-xs-12"> 	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "main_block_inc.php"
	)
);?> 	</div>
   </div>
 
  <div style="clear: both;"></div>
 </div>
 <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>