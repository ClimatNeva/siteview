<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Установка кондиционеров в квартиры и дома. Большой ассортимент, инженерная поддержка. Бесплатная доставка. Звоните: +7 (812) 642-40-20");
$APPLICATION->SetPageProperty("keywords", "кондиционеры для дома, кондиционеры для квартиры, бытовые кондиционеры");
$APPLICATION->SetPageProperty("title", "Кондиционеры для дома и квартиры в Санкт-Петербурге | Климат Нева ©");
$APPLICATION->SetTitle("Кондиционеры для дома и квартиры");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/uslugi.css", true);
?>
<div><? \BH\Frontend\Frontend::includeArea('index-1') ?>
<h2 class="uslugi-blocks-h2"><? \BH\Frontend\Frontend::includeArea('index-10') ?></h2>
<ul class="uslugi-blocks">
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/uroven_shuma-to-30/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/for_bedroom.jpg" alt="Для спальни" title="Для спальни">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-2') ?></div>
		</a>
	</li>
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/uroven_shuma-from-30-to-40/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/for_living_room.jpg" alt="Для гостиной" title="Для гостиной">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-3') ?></div>
		</a>
	</li>
</ul>
<h2 class="uslugi-blocks-h2"><? \BH\Frontend\Frontend::includeArea('index-11') ?></h2>
<ul class="uslugi-blocks">
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/max_obsl_ploshad-to-20/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/for-20m.jpg" alt="Для помещений до 20 кв.м" title="Для помещений до 20 кв.м">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-4') ?></div>
		</a>
	</li>
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/max_obsl_ploshad-from-20-to-30/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/for-20-30m.jpg" alt="Для помещений от 20 до 30 кв.м" title="Для помещений от 20 до 30 кв.м">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-5') ?></div>
		</a>
	</li>
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/max_obsl_ploshad-from-30-to-40/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/for-30-40m.jpg" alt="Для помещений от 30 до 40 кв.м" title="Для помещений от 30 до 40 кв.м">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-6') ?></div>
		</a>
	</li>
</ul>
<h2 class="uslugi-blocks-h2"><? \BH\Frontend\Frontend::includeArea('index-12') ?></h2>
<ul class="uslugi-blocks">
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/price-base-to-20000/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/price1.jpg" alt="до 20 000 руб." title="до 20 000 руб.">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-7') ?></div>
		</a>
	</li>
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/price-base-from-20001-to-30000/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/price2.jpg" alt="от 20 000 до 30 000 руб." title="от 20 000 до 30 000 руб.">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-8') ?></div>
		</a>
	</li>
	<li>
		<a href="/catalog/bytovye-konditsionery-dlya-doma-i-kvartiry/filter/price-base-from-30001-to-100000/apply/">
			<div class="uslugi-blocks-img">
				<img src="/images/cond/price3.jpg" alt="от 30 000 до 100 000 руб." title="от 30 000 до 100 000 руб.">
			</div>
			<div class="uslugi-blocks-text"><? \BH\Frontend\Frontend::includeArea('index-9') ?></div>
		</a>
	</li>
</ul>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>