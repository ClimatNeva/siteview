<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if ($request->get('ajax') == 'Y') {
    CModule::IncludeModule('form');
    
    $element = CFormResult::Add(
        2,
        array(
            'form_text_6' => $request->get('NAME'),
            'form_text_7' => $request->get('EMAIL'),
            'form_text_8' => $request->get('PHONE'),
            'form_text_9' => $request->get('obj-id'),
            'form_text_10' => ((CMain::IsHTTPS()) ? "https://" : "http://").$_SERVER['SERVER_NAME'].'/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=16&type=content&ID='.$request->get('obj-id').'&lang=ru&WF=Y',
        )
    );

    if(intval($element) > 0)
        exit('ADDED');
    else {
        global $strError;
        $outVal = '';
        foreach ($_REQUEST as $key => $val) {
            $outVal .= "\n$key :: $val :: ".$request->get($key);
        }
        $outVal .= "\n".$strError;
        exit("ERROR".$outVal);
    }
};
?>