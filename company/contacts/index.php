<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты Климат Нева");
?>
<div class="bxr-contacts-block">
<div itemscope="" itemtype="http://schema.org/LocalBusiness">
<p><span itemprop="name">Климат Нева</span></p>
<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
<p><i class="fa fa-map-marker" aria-hidden="true"></i> <span itemprop="postalCode">195067</span>, г.<span itemprop="addressLocality">Санкт-Петербург</span>, <span itemprop="streetAddress">Пискаревский пр, дом 25, литер А</span>, офис 33</p>
</div>
<p><i class="fa fa-phone" aria-hidden="true"></i> <span itemprop="telephone">+7 (812) 642-40-20</span></p>
<p><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:info@climat-neva.ru"><span itemprop="email">info@climat-neva.ru</span></a></p>
<p><i class="fa fa-clock-o" aria-hidden="true"></i> <time itemprop="openingHours" datetime="Mo-Fr 09:00-18:00">понедельник - пятница, 09:00-18:00</time></p>
</div>
</div>
 <br>
 <h2>Как до нас добраться</h2>
 <script charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A0cd3592e5b155bca13274e4edabd206f5dc76d2da8edeebac6159c991bcfb02b&amp;width=100%25&amp;height=446&amp;lang=ru_RU&amp;scroll=true"></script>
<!-- : <br>
 </b><b>&nbsp;&nbsp;</b><?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"CONTROLS" => array(0=>"SMALL_ZOOM_CONTROL",1=>"TYPECONTROL",2=>"SCALELINE",),
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.16215366489561;s:10:\"google_lon\";d:61.43184212646453;s:12:\"google_scale\";i:14;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:7:\"BXReady\";s:3:\"LON\";d:61.434173583984;s:3:\"LAT\";d:55.162494717295;}}}",
		"MAP_HEIGHT" => "300",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DBLCLICK_ZOOM",2=>"ENABLE_DRAGGING",3=>"ENABLE_KEYBOARD",)
	)
);?>-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>