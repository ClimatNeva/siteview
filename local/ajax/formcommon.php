<?require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if (empty($request->get('WEB_FORM_ID')))
    exit('ERROR: No web-form set');

if (!empty($request->get('step')) && $request->get('step') == 'q') {
    $template = "mhi.popup";
    if (!empty($request->get('template')))
        $template = $request->get('template');
    $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        $template,
        Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "CHAIN_ITEM_LINK" => "",
            "CHAIN_ITEM_TEXT" => "",
            "EDIT_URL" => "result_edit.php",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "LIST_URL" => "formajax.php",
            "SEF_FOLDER" => "/local/ajax/",
            "SEF_MODE" => "Y",
            "SUCCESS_URL" => "",
            "USE_EXTENDED_ERRORS" => "N",
            "WEB_FORM_ID" => $request->get('WEB_FORM_ID')
        ),
        false,
        array('HIDE_ICONS' => 'Y')
    );
} else {
    if (!empty($request->get("NAME"))/* || empty($request->get("recaptcha_response"))*/) {
        exit('LUCKY');
    }

    if (!empty($request->get("recaptcha_response"))){
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_params = [
            'secret' => RECAPTCHA_SERVER_V3_KEY,
            'response' => $request->get("recaptcha_response"),
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ];

        $ch = curl_init($recaptcha_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $recaptcha_params);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $response = curl_exec($ch);

        if (!empty($response)) {
            $decoded_response = json_decode($response);
        } else {
            exit('ERROR: Unable to verify recaptcha');
        }

        if (empty($decoded_response->score) || $decoded_response->score < 0.5) {
            $f = fopen($_SERVER["DOCUMENT_ROOT"]."/local/log/failed_forms.log","a+");
            fwrite($f,"\nNew record: ".date('d.m.Y H:i:s')."\n".showVarDump($decoded_response));
            fclose($f);
            exit('LUCKY');
        }
    }

    $webFormID = intval($request->get('WEB_FORM_ID'));
    CModule::IncludeModule('form');

    $arForm = CForm::GetByID($webFormID)->Fetch();
    if (!$arForm) {
        exit("ERROR Failed to get form data");
    }

    $arMsgTemplate = [];
    $arFields = [];
    $res = CFormField::GetList($webFormID,'ALL',$by="s_id", $order="desc",$arFilter=[],$is_filtered=false);
    if (!$res) {
        exit("ERROR Failed to get form fields data");
    }
    while ($row = $res->Fetch()) {
        $rAnswer = CFormAnswer::GetList($row['ID'],$by="s_id",$order="desc",$arFilter=[],$is_filtered=false)->GetNext();
        if ($rAnswer["FIELD_TYPE"] == "multiselect") {
            $arQ = $request->get('multiselect_name');
        } else if ($rAnswer["FIELD_TYPE"] == "dropdown") {
            $arQ = 'form_'.$rAnswer['FIELD_TYPE'].'_'.$row['SID'];
        } else {
            $arQ = 'form_'.$rAnswer['FIELD_TYPE'].'_'.$rAnswer['ID'];
        }
        $arFields[$arQ] = $request->get($arQ);
        $arMsgTemplate[$row["SID"]] = $request->get($arQ);
    }

    $element = CFormResult::Add($webFormID,$arFields);
    if(intval($element) > 0) {
        $arEventFields = array(
            "RS_FORM_ID" => $webFormID,
            "RS_FORM_NAME" => $arForm["NAME"],
            "RS_RESULT_ID" => $element,
            "RS_DATE_CREATE" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()),
            "RS_LINK" => "/bitrix/admin/form_result_edit.php?lang=ru&WEB_FORM_ID=".$webFormID."&RESULT_ID=".$element."&WEB_FORM_NAME=".$arForm["SID"]
        );
        $arEventFields = array_merge($arEventFields,$arMsgTemplate);
        CEvent::Send($arForm["MAIL_EVENT_TYPE"],"s1",$arEventFields);
        exit('LUCKY');
    } else {
        global $strError;
        $outVal = '';
        foreach ($_REQUEST as $key => $val) {
            $outVal .= "\n$key :: $val :: ".$request->get($key);
        }
        $outVal .= "\n".$strError;
        save2log($strError);
        exit("ERROR".$outVal);
    }
}
?>