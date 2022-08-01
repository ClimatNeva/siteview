<?
if (
    ((isset($_POST["USER_LOGIN"]) || isset($_REQUEST["USER_LOGIN"])) && !isset($_REQUEST["ROBOT"]))
    || (isset($_REQUEST["ROBOT"]) && $_REQUEST["ROBOT"] != 'a-man')
) {
    $_GET["register"] = "no";
    $_POST["USER_LOGIN"] = "";
    $_REQUEST["USER_LOGIN"] = "";
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки пользователя");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"eshop", 
	array(
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => "eshop",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"USER_PROPERTY" => array(
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>