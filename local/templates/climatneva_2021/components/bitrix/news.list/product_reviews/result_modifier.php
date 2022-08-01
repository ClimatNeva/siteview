<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main\Type\DateTime;

$arAuthorID = array();
foreach ($arResult['ITEMS'] as $arItem) {
    if (isset($arItem['PROPERTIES']['REV_AUTHOR']['VALUE']) && $arItem['PROPERTIES']['REV_AUTHOR']['VALUE'] != '') {
        $arAuthorID[] = $arItem['PROPERTIES']['REV_AUTHOR']['VALUE'];
    }
}

if (sizeof($arAuthorID) > 0) {
    $order = array();
    $sort = '';
    $dbRes = CUser::GetList($order,$sort,array("ID" => implode($arAuthorID,'|')));
    while ($arRes = $dbRes->GetNext()) {
        $arResult['AUTHORS'][$arRes['ID']] = $arRes['NAME'].' '.$arRes['LAST_NAME'];
    }
}

$currentDate = mktime();
foreach ($arResult['ITEMS'] as $key=>$arItem) {
    $thisReviewDate = MakeTimeStamp($arItem["ACTIVE_FROM"]);
    $datesDiff = floor(($currentDate - $thisReviewDate)/86400);
    if ($datesDiff > 3) {
        $arResult['ITEMS'][$key]["PROPERTIES"]["REV_DATE"] = CIBlockFormatProperties::DateFormat('j F Y', $thisReviewDate).' г.';
    } else {
        switch ($datesDiff) {
            case 0:
                $arResult['ITEMS'][$key]["PROPERTIES"]["REV_DATE"] = 'сегодня';
                break;
            case 1:
                $arResult['ITEMS'][$key]["PROPERTIES"]["REV_DATE"] = '1 день назад';
                break;
            case 2:
            case 3:
                $arResult['ITEMS'][$key]["PROPERTIES"]["REV_DATE"] = $datesDiff.' дня назад';
                break;
        }
    }
}

?>