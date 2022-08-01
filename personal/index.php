<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?><div class="bx_page">
	<p>
		В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки.
	</p>
	<div>
		<h2>Личная информация</h2>
 <a href="profile/">Изменить регистрационные данные</a><br>
 <a href="subscribe/">Подписки</a><br>
	</div>
	<div>
		<h2>Заказы</h2>
 <a href="order/">Ознакомиться с состоянием заказов</a><br>
 <a href="basket/">Посмотреть содержимое корзины</a><br>
 <a href="order/">Посмотреть историю заказов</a>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:sender.subscribe", 
	"market_horizontal", 
	array(
		"COMPONENT_TEMPLATE" => "market_horizontal",
		"USE_PERSONALIZATION" => "Y",
		"SHOW_HIDDEN" => "N",
		"PAGE" => "/personal/subscribe/subscr_edit.php",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SHOW_RUBRICS" => "Y",
		"CONFIRMATION" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_TITLE" => "Y"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>