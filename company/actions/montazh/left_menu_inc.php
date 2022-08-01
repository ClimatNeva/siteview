<?
use Alexkova\Market\Core;

$BXReady = \Alexkova\Market\Core::getInstance();
?>

<?
// LeftMenu
global $arLeftMenu;
if (strlen($arLeftMenu["TYPE"])) {
	switch ($arLeftMenu["TYPE"]) {
		case "with_catalog": $BXReady->setAreaType('left_menu_type', 'v3'); break;
		case "only_catalog": $BXReady->setAreaType('left_menu_type', 'v2'); break;
		case "without_catalog": $BXReady->setAreaType('left_menu_type', 'v1'); break;
	}
}
if ($BXReady->getArea('left_menu_type')){
        include($BXReady->getAreaPath('left_menu_type'));
};
// end LeftMenu
?>
