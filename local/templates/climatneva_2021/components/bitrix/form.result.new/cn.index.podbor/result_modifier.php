<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("fileman");
CMedialib::Init();
$mediaLibraryID = !empty($arParams["MEDIALIBRARY_COLLECTION"]) ? $arParams["MEDIALIBRARY_COLLECTION"] : "16";
$arResult["BACKGROUNDS"] = CMedialibItem::GetList(['arCollections' => [$mediaLibraryID]]);
if (empty($arResult["BACKGROUNDS"])) {
  $arResult["BACKGROUNDS"][0]["PATH"] = "/img/jpg/bg_triz.jpg";
} else {
  $arResult["BACKGROUNDS"][0]["SRC"] = $arResult["BACKGROUNDS"][0]["PATH"];
}

foreach ($arResult["QUESTIONS"] as $FIELD_SID => &$arQuestion)
{
    $arResult["FIELDS"][$arQuestion["CAPTION"]] = strtr($FIELD_SID, ["&lt;"=>"<"]);
    if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden')
    {
        switch ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) {
            case 'text':
                $strReplace = " id=\"form_".$arQuestion["STRUCTURE"][0]["FIELD_TYPE"]."_".$arQuestion["STRUCTURE"][0]["ID"]."\" data-req=\"".$arQuestion["REQUIRED"]."\" placeholder=\"".$arQuestion["CAPTION"]."\" value=";
                if (strpos(mb_strtolower($arQuestion["CAPTION"]), "лефон") != false) {
                    $strReplace = " data-type=\"phone\"".$strReplace;
                } elseif (strpos(mb_strtolower($arQuestion["CAPTION"]), "mail") != false) {
                    $strReplace = " data-type=\"email\"".$strReplace;
                } else {
                    $strReplace = " data-type=\"text\"".$strReplace;
                }
                $arQuestion["HTML_CODE"] = strtr($arQuestion["HTML_CODE"],["value=" => $strReplace]);
                break;
            case 'textarea':
                $strReplace = " id=\"form_".$arQuestion["STRUCTURE"][0]["FIELD_TYPE"]."_".$arQuestion["STRUCTURE"][0]["ID"]."\" data-type=\"text\" data-req=\"".$arQuestion["REQUIRED"]."\" placeholder=\"".$arQuestion["CAPTION"]."\" class=";
                $arQuestion["HTML_CODE"] = strtr($arQuestion["HTML_CODE"],[" class=" => $strReplace]);
                break;
            case 'file':
                $arQuestion["HTML_CODE"] = strtr($arQuestion["HTML_CODE"],["name="=>" data-text=\"".$arQuestion["CAPTION"]."\" data-type=\"text\" id=\"form_".$arQuestion["STRUCTURE"][0]["FIELD_TYPE"]."_".$arQuestion["STRUCTURE"][0]["ID"]."\" data-req=\"".$arQuestion["REQUIRED"]."\" name="]);
                break;
            case 'multiselect':
                $arQuestion["HTML_CODE"] = strtr($arQuestion["HTML_CODE"],["name="=>" data-text=\"".$arQuestion["CAPTION"]."\" data-type=\"multiselect\" id=\"form_multiselect_".$FIELD_SID."\" data-req=\"".$arQuestion["REQUIRED"]."[]\" name="]);
                $outStr = '<div class="data-head-div">'.$arQuestion["CAPTION"].'</div><div class="data-input-wrapper"><div class="data-input-outer"><div class="data-input-div">';
                foreach ($arQuestion["STRUCTURE"] as $field) {
                    $outStr .= '<input name="'.$FIELD_SID.'" id="'.$FIELD_SID.'['.$field["ID"].']" data-parent="form_multiselect_'.$FIELD_SID.'" type="checkbox" value="'.$field["ID"].'" class="hidden-checkbox multiple-select"><label for="'.$FIELD_SID.'['.$field["ID"].']" class="box-label">'.$field["MESSAGE"].'</label>';
                }
                $outStr .= '</div></div></div><input type="hidden" name="multiselect_name" value="form_multiselect_'.$FIELD_SID.'">';
                $arQuestion["HTML_CODE"] .= $outStr;
                break;
            case 'dropdown':
                $arQuestion["HTML_CODE"] = strtr($arQuestion["HTML_CODE"],["name="=>" data-text=\"".$arQuestion["CAPTION"]."\" data-type=\"dropdown\" id=\"form_dropdown_".$FIELD_SID."\" data-req=\"".$arQuestion["REQUIRED"]."[]\" name="]);
                $outStr = '<div class="data-head-div">'.$arQuestion["CAPTION"].'</div><div class="data-input-wrapper"><div class="data-input-outer"><div class="data-input-div">';
                foreach ($arQuestion["STRUCTURE"] as $field) {
                    $outStr .= '<input name="'.$FIELD_SID.'" id="'.$FIELD_SID.'['.$field["ID"].']" data-parent="form_dropdown_'.$FIELD_SID.'" type="radio" value="'.$field["ID"].'" class="hidden-radio dropdown-select"><label for="'.$FIELD_SID.'['.$field["ID"].']" class="box-label">'.$field["MESSAGE"].'</label>';
                }
                $outStr .= '</div></div></div><input type="hidden" name="dropdown_name" value="form_dropdown_'.$FIELD_SID.'">';
                $arQuestion["HTML_CODE"] .= $outStr;
                break;
            default:
                $arQuestion["HTML_CODE"] = strtr($arQuestion["HTML_CODE"],["name="=>" data-type=\"text\" id=\"form_".$arQuestion["STRUCTURE"][0]["FIELD_TYPE"]."_".$arQuestion["STRUCTURE"][0]["FIELD_ID"]."\" data-req=\"".$arQuestion["REQUIRED"]."\" name="]);
        }
    }
}
