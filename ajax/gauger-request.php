<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if ($request->get('ajax') == 'Y') {
    CModule::IncludeModule('form');
    
    $element = CFormResult::Add(
        1,
        array(
            'form_text_1' => $request->get('NAME'),
            'form_text_2' => $request->get('PHONE'),
            'form_text_3' => $request->get('ADDRESS'),
            'form_text_4' => $request->get('eq-id'),
            'form_text_5' => ((CMain::IsHTTPS()) ? "https://" : "http://").$_SERVER['SERVER_NAME'].'/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=12&type=catalog&ID='.$request->get('eq-id').'&lang=ru&WF=Y',
        )
    );

    if(intval($element) > 0) {
        $arEventFields = array(
            "RS_FORM_ID" => "1",
            "RS_FORM_NAME" => "Вызов замерщика",
            "RS_RESULT_ID" => $element,
            "RS_DATE_CREATE" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()),
            "name" => $request->get('NAME'),
            "phone" => $request->get('PHONE'),
            "address" => $request->get('ADDRESS'),
            "equipment" => $request->get('eq-id'),
            "" => "",
        );
        CEvent::Send("FORM_FILLING_SIMPLE_FORM_1","s1",$arEventFields);
        exit('ADDED');
    } else {
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