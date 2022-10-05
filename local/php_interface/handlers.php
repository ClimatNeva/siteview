<?
// require_once 'bitrix-helpers/bitrix-helpers.php';
// \BH\Frontend\BitrixHelper::init();


AddEventHandler("main", "OnPageStart", "__OnPageStartHandler");

function __OnPageStartHandler(){
    require_once ($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/classes/general.php');
}

//AddEventHandler('main','OnEpilog',array('sysMain','onEpilogHandler'));

AddEventHandler('main','OnBeforeEndBufferContent',array('sysMain','onEpilogHandler'));

AddEventHandler ('main', 'OnEndBufferContent', array('sysMain','optimizeContent'));

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("iblockElementPriceSorter", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("iblockElementPriceSorter", "OnAfterIBlockElementUpdateHandler"));

AddEventHandler("sale", "OnOrderNewSendEmail", "OnOrderNewSendEmail");

function OnOrderNewSendEmail($orderID, &$eventName, &$arFields) {
 
    // получаем параметры заказа по ID
    $arOrder = CSaleOrder::GetByID($orderID);

    $arFields["ORDER_ADMIN_URL"] = "/bitrix/admin/sale_order_view.php?ID=".$orderID;
    $arFields["COMMENT"] = $arOrder["USER_DESCRIPTION"];
    $arFields["PRICE"] = $arOrder["PRICE"];
    $arFields["PHONE"] = $arOrder["PHONE"];
 
    // получаем название службы доставки
    $arDeliv = CSaleDelivery::GetByID($arOrder['DELIVERY_ID']);
    if ($arDeliv) {
        $arFields["DELIVERY"] = $arDeliv['NAME'];
    }

    // получаем свойства заказа
    $orderProps = CSaleOrderPropsValue::GetOrderProps($orderID);
 
    // проходим циклом по всем свойствам и вытаскиваем нужные нам
    while ($arProps = $orderProps->Fetch()) {
        if ($arProps["CODE"] == "ADDRESS") {
            $arFields["ADDRESS"] = $arProps['VALUE'];
        }
    }
 
    // получаем название платежной системы
    $arPaySystem = CSalePaySystem::GetByID($arOrder['PAY_SYSTEM_ID']);
    if ($arPaySystem) {
        $arFields["PAYMENT_SYSTEM"] = $arPaySystem['NAME'];
    }
}

?>