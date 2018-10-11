<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Интернет-магазин климатической техники компании Климат Нева");
?><br>
<h1><?$APPLICATION->ShowTitle(false);?></h1>
<div class="row">
<div class="col-xs-12 col-sm-4 col-md-2">
 <!--<a href="#SITE_ID#company/">--><img src="<?=SITE_DIR?>images/logo.jpg" alt="Интернет-магазин климатической техники компании Климат Нева" title="Интернет-магазин климатической техники компании Климат Нева" style="float: left; margin-bottom: 20px; max-width: 100%;"><!--</a>-->
<br>
</div>
<div class="col-xs-12 col-sm-8 col-md-10">
	В компании <b>Климат Нева</b> <span style="color: #252525; background-color: #ffffff;">вы можете приобрести все виды климатической техники.<br>
 </span><b><br>
	 В ассортименте:</b><br>
	<ul>
 <li>кондиционеры;</li>
 <li>системы вентиляции;</li>
 <li>электрокамины.</li>
	</ul>
 <b>Сообщите, что вам необходимо и наши специалисты подберут оптимальное оборудование для ваших помещений!</b>
</div>
</div>
 <br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>