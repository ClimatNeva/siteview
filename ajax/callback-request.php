<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if ($request->get('ajax') == 'Y') {
    CModule::IncludeModule('form');
    if (!empty($request->get('WEB_FORM_ID')) && $request->get('WEB_FORM_ID') != 3) {
        $webForm = $request->get('WEB_FORM_ID');
        $arFields = ['form_text_13', 'form_text_14'];
    } else {
        $webForm = 3;
        $arFields = ['form_text_11', 'form_text_12'];
    }
    $formFields = array(
            $arFields[0] => $request->get($arFields[0]),
            $arFields[1] => $request->get($arFields[1])
    );
    if (!empty($request->get('form_text_15'))) {
        $formFields['form_text_15'] = $request->get('form_text_15');
    }

    $arForm = CForm::GetByID($webForm)->Fetch();
    if (!$arForm) {
        exit("ERROR Failed to get form data");
    }

    $element = CFormResult::Add(
        $webForm,
        $formFields
    );

    if(intval($element) > 0) {
        $arEventFields = array(
            "RS_FORM_ID" => $webForm,
            "RS_FORM_NAME" => $arForm["NAME"],
            "RS_RESULT_ID" => $element,
            "RS_DATE_CREATE" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()),
            "RS_LINK" => "/bitrix/admin/form_result_edit.php?lang=ru&WEB_FORM_ID=".$webForm."&RESULT_ID=".$element."&WEB_FORM_NAME=".$arForm["SID"]
        );
        $arEventFields = array_merge($arEventFields,$formFields);
        CEvent::Send($arForm["MAIL_EVENT_TYPE"],"s1",$arEventFields);
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