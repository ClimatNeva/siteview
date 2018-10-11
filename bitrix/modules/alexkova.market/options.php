<?
$module_id = "alexkova.market";
$bxready_id = "alexkova.bxready";

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$module_id."/include.php");
Include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$bxready_id."/lib/library.php");
Include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$module_id."/lib/core.php");
Include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/localization/lib/loc.php");
IncludeModuleLangFile(__FILE__);

use Alexkova\Bxready\Library;
use Alexkova\Market\Core;

CJSCore::init('jquery');
CJSCore::init('jquery-ui');

$RK_RIGHT = $APPLICATION->GetGroupRight($module_id);
$aTabs = array(
	array("DIV" => "edit1", "TAB" => GetMessage("BASE"), "TITLE" => GetMessage("BASE")),
        array("DIV" => "edit2", "TAB" => GetMessage("CARD_VIEW"), "TITLE" => GetMessage("CARD_VIEW")),
	array("DIV" => "edit3", "TAB" => GetMessage("BXREADY_BANNER_SETTINGS"), "TITLE" => GetMessage("BXREADY_BANNER_SETTINGS")),
	array("DIV" => "edit4", "TAB" => "LESS", "TITLE" => "LESS"),
	array("DIV" => "edit5", "TAB" => GetMessage("AMK_ACCESS"), "TITLE" => GetMessage("AMK_ACCESS_TITLE")),
	array("DIV" => "edit6", "TAB" => GetMessage("BXREADY_SCHEMA_SETTINGS"), "TITLE" => GetMessage("BXREADY_SCHEMA_SETTINGS_TITLE")),
        array("DIV" => "edit7", "TAB" => GetMessage("BXREADY_PRICE_SETTINGS"), "TITLE" => GetMessage("BXREADY_PRICE_SETTINGS_TITLE")),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);
if ($REQUEST_METHOD=="GET" && $RK_RIGHT=="W" && strlen($RestoreDefaults)>0 && check_bitrix_sessid())
{
	COption::RemoveOption($module_id);
	$z = CGroup::GetList($v1="id",$v2="asc", array("ACTIVE" => "Y", "ADMIN" => "N"));
	while($zr = $z->Fetch())
		$APPLICATION->DelGroupRight($module_id, array($zr["ID"]));
}
if($REQUEST_METHOD=="POST" && strlen($Update.$Apply)>0 && $RK_RIGHT>="W" && check_bitrix_sessid())
{
	$old_days = intval(COption::GetOptionString($module_id, "STAT_DAYS"));

	$new_days= intval($HTTP_POST_VARS["STAT_DAYS"]);

	$new_group = serialize($HTTP_POST_VARS["EXC_GROUP"]);
	COption::SetOptionString($module_id, "EXCLUDE_GROUPS", $new_group);
	COption::SetOptionString($module_id, "managment_mode", $HTTP_POST_VARS["managment_mode"]);
	COption::SetOptionString($module_id, "list_marker_type", $HTTP_POST_VARS["list_marker_type"]);
        COption::SetOptionString($module_id, "list_price_type", serialize($HTTP_POST_VARS["list_price_type"]));
	COption::SetOptionString($module_id, "ratio_settings", $HTTP_POST_VARS["ratio_settings"]);
	COption::SetOptionString($module_id, "bxr_ratio_prop_code", $HTTP_POST_VARS["bxr_ratio_prop_code"]);

        COption::SetOptionString($module_id, "bxr_min_order_price", $HTTP_POST_VARS["bxr_min_order_price"]);
        COption::SetOptionString($module_id, "bxr_min_order_price_msg", $HTTP_POST_VARS["bxr_min_order_price_msg"]);

        COption::SetOptionString($module_id, "bxr_use_links_sku", $HTTP_POST_VARS["bxr_use_links_sku"]);
        COption::SetOptionString($module_id, "bxr_select_first_sku", $HTTP_POST_VARS["bxr_select_first_sku"]);

	COption::SetOptionString($module_id, "bxr_market_top_banner", $HTTP_POST_VARS["bxr_market_top_banner"]);
	COption::SetOptionString($module_id, "bxr_market_bottom_banner", $HTTP_POST_VARS["bxr_market_bottom_banner"]);
	COption::SetOptionString($module_id, "bxr_market_catalog_top_banner", $HTTP_POST_VARS["bxr_market_catalog_top_banner"]);
	COption::SetOptionString($module_id, "bxr_market_catalog_bottom_banner", $HTTP_POST_VARS["bxr_market_catalog_bottom_banner"]);
	COption::SetOptionString($module_id, "bxr_market_left_banner", $HTTP_POST_VARS["bxr_market_left_banner"]);

	if (strlen($HTTP_POST_VARS["bxr_less_template_id"]) > 0){
		COption::SetOptionString($module_id, "bxr_less_base_color_".$HTTP_POST_VARS["bxr_less_template_id"], $HTTP_POST_VARS["bxr_less_base_color_".$HTTP_POST_VARS["bxr_less_template_id"]]);
		COption::SetOptionString($module_id, "bxr_less_darken_".$HTTP_POST_VARS["bxr_less_template_id"], $HTTP_POST_VARS["bxr_less_darken_".$HTTP_POST_VARS["bxr_less_template_id"]]);
		COption::SetOptionString($module_id, "bxr_less_lighten_".$HTTP_POST_VARS["bxr_less_template_id"], $HTTP_POST_VARS["bxr_less_lighten_".$HTTP_POST_VARS["bxr_less_template_id"]]);
	}

        if (strlen($HTTP_POST_VARS["bxr_template_id"]) > 0){
            COption::SetOptionString($module_id, "catalog_list_element_type_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_type_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "catalog_list_element_type_list_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_type_list_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "catalog_list_element_type_table_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_type_table_".$HTTP_POST_VARS["bxr_template_id"]]);

            COption::SetOptionString($module_id, "own_catalog_list_element_type_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["own_catalog_list_element_type_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "own_catalog_list_element_type_list_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["own_catalog_list_element_type_list_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "own_catalog_list_element_type_table_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["own_catalog_list_element_type_table_".$HTTP_POST_VARS["bxr_template_id"]]);

            COption::SetOptionString($module_id, "catalog_list_element_count_lg_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_count_lg_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "catalog_list_element_count_md_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_count_md_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "catalog_list_element_count_sm_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_count_sm_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "catalog_list_element_count_xs_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["catalog_list_element_count_xs_".$HTTP_POST_VARS["bxr_template_id"]]);

            COption::SetOptionString($module_id, "list_element_type_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["list_element_type_".$HTTP_POST_VARS["bxr_template_id"]]);
            COption::SetOptionString($module_id, "own_list_element_type_".$HTTP_POST_VARS["bxr_template_id"], $HTTP_POST_VARS["own_list_element_type_".$HTTP_POST_VARS["bxr_template_id"]]);
        }

        COption::SetOptionString($module_id, "managment_element_mode", $HTTP_POST_VARS["managment_element_mode"]);

        COption::SetOptionString($module_id, "bxr_org_name", $HTTP_POST_VARS["bxr_org_name"]);
        COption::SetOptionString($module_id, "bxr_org_phone", $HTTP_POST_VARS["bxr_org_phone"]);
        COption::SetOptionString($module_id, "bxr_org_email", $HTTP_POST_VARS["bxr_org_email"]);
        COption::SetOptionString($module_id, "bxr_org_type", $HTTP_POST_VARS["bxr_org_type"]);
        COption::SetOptionString($module_id, "bxr_org_fax", $HTTP_POST_VARS["bxr_org_fax"]);
        COption::SetOptionString($module_id, "bxr_org_address_city", $HTTP_POST_VARS["bxr_org_address_city"]);
        COption::SetOptionString($module_id, "bxr_org_address_street", $HTTP_POST_VARS["bxr_org_address_street"]);
        COption::SetOptionString($module_id, "bxr_org_address_zip", $HTTP_POST_VARS["bxr_org_address_zip"]);
        COption::SetOptionString($module_id, "bxr_org_description", $HTTP_POST_VARS["bxr_org_description"]);

	$arPICTURE = $HTTP_POST_FILES["bxr_org_logo"];
	$arPICTURE["del"] = ${"bxr_org_logo_del"};
	$arPICTURE["MODULE_ID"] = $module_id;
	if ($old_fid = COption::GetOptionInt($module_id, "bxr_org_logo")) {
		$arPICTURE["old_file"] = $old_fid;
	}
	$checkRes = CFile::CheckImageFile($arPICTURE, 0, 0, 0);
	if (strlen($checkRes) <= 0) {
		$fid = CFile::SaveFile($arPICTURE, $module_id);
		if ($arPICTURE["del"] == "Y" || strlen($HTTP_POST_FILES["bxr_org_logo"]["name"]) > 0)
			COption::SetOptionInt($module_id, "bxr_org_logo", intval($fid));
	}
	else
		CAdminMessage::ShowMessage($checkRes);


        COption::SetOptionString($module_id, "bxr_org_opengraph", $HTTP_POST_VARS["bxr_org_opengraph"]);

	$Update = $Update.$Apply;
	ob_start();
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
	ob_end_clean();

	if (strlen($HTTP_POST_VARS["bxr_less_template_id"]) > 0){
		Alexkova\Market\Core::getInstance()->initLess($HTTP_POST_VARS["bxr_less_template_id"]);
	}

	if($Apply == '' && $_REQUEST["back_url_settings"] <> '')
		LocalRedirect($_REQUEST["back_url_settings"]);
	else
		LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());

}

$bxr_org_name = COption::GetOptionString($module_id, "bxr_org_name");
$bxr_org_phone = COption::GetOptionString($module_id, "bxr_org_phone");
$bxr_org_email = COption::GetOptionString($module_id, "bxr_org_email");
$bxr_org_type = COption::GetOptionString($module_id, "bxr_org_type");
$bxr_org_fax = COption::GetOptionString($module_id, "bxr_org_fax");
$bxr_org_address_city = COption::GetOptionString($module_id, "bxr_org_address_city");
$bxr_org_address_street = COption::GetOptionString($module_id, "bxr_org_address_street");
$bxr_org_address_zip = COption::GetOptionString($module_id, "bxr_org_address_zip");
$bxr_org_description = COption::GetOptionString($module_id, "bxr_org_description");
$bxr_org_logo = COption::GetOptionString($module_id, "bxr_org_logo");
$bxr_org_opengraph = COption::GetOptionString($module_id, "bxr_org_opengraph", "Y");
$managment_mode = COption::GetOptionString($module_id, "managment_mode", "N");
$list_marker_type = COption::GetOptionString($module_id, "list_marker_type");
$list_price_type = unserialize(COption::GetOptionString($module_id, "list_price_type"));
$ratio_settings = COption::GetOptionString($module_id, "ratio_settings","none");
$bxr_ratio_prop_code = COption::GetOptionString($module_id, "bxr_ratio_prop_code");

$bxr_min_order_price = COption::GetOptionString($module_id, "bxr_min_order_price");
$bxr_min_order_price_msg = COption::GetOptionString($module_id, "bxr_min_order_price_msg", GetMessage("BXR_MIN_ORDER_PRICE_MSG"));

$bxr_use_links_sku = COption::GetOptionString($module_id, "bxr_use_links_sku", "N");
$bxr_select_first_sku = COption::GetOptionString($module_id, "bxr_select_first_sku", "N");

$bxr_market_top_banner = COption::GetOptionString($module_id, "bxr_market_top_banner");
$bxr_market_bottom_banner = COption::GetOptionString($module_id, "bxr_market_bottom_banner");
$bxr_market_catalog_top_banner = COption::GetOptionString($module_id, "bxr_market_catalog_top_banner");
$bxr_market_catalog_bottom_banner = COption::GetOptionString($module_id, "bxr_market_catalog_bottom_banner");
$bxr_market_left_banner = COption::GetOptionString($module_id, "bxr_market_left_banner");
$bxr_less_template_id = $HTTP_POST_VARS["bxr_less_template_id"];
$bxr_template_id = $HTTP_POST_VARS["bxr_template_id"];

$managment_element_mode = COption::GetOptionString($module_id, "managment_element_mode", "N");
//$list_element_type = COption::GetOptionString($module_id, "list_element_type");
//$list_element_count_lg = COption::GetOptionString($module_id, "list_element_count_lg");
//$list_element_count_md = COption::GetOptionString($module_id, "list_element_count_md");
//$list_element_count_sm = COption::GetOptionString($module_id, "list_element_count_sm");
//$list_element_count_xs = COption::GetOptionString($module_id, "list_element_count_xs");

$managment_mode_display = 'style="display:none"';
if ($managment_mode == "Y"){
	$managment_mode_display = '';
}

//$elementList = Alexkova\Bxready\Library::getElementList();
$elementGrid = array(
    "ecommerce.v1.lite" => "ecommerce.v1.lite",
    "ecommerce.v2.lite" => "ecommerce.v2.lite",
    "ecommerce.v3.lite" => "ecommerce.v3.lite",
    "ecommerce.v3.lite.color" => "ecommerce.v3.lite.color",
	"ecommerce.v4.effect" => "ecommerce.v4.effect",
    "ecommerce_v1" => "ecommerce_v1"
);
$elementList = array(
    "ecommerce_v1_list" => "ecommerce_v1_list",
    "ecommerce_v2_list" => "ecommerce_v2_list"
);
$elementTable = array(
    "ecommerce_v1_table" => "ecommerce_v1_table"
);

$elementListCount12 = array(
    12 => 1,
    6 => 2,
    4 => 3,
    3 => 4,
    2 => 6,
    1 => 12
);
$elementListCount10 = array(
    10 => 1,
    5 => 2,
    2 => 5,
    1 => 10
);


if(CModule::IncludeModule("catalog"))
{
    $dbPriceType = CCatalogGroup::GetList();
    $arPrice = array();
    while ($arPriceType = $dbPriceType->Fetch())
    {
        $arPrice[$arPriceType["ID"]] = $arPriceType["NAME"];
        if(!empty($arPriceType["NAME_LANG"]))
            $arPrice[$arPriceType["ID"]] .= " (".$arPriceType["NAME_LANG"].")";
    }
}

$markerList = Alexkova\Bxready\Library::getMarkerList();
$lessTemplatesList = Alexkova\Market\Core::getInstance()->getLessTemplates();
$lessTemplatesOption = array();
foreach ($lessTemplatesList as $template){
	$lessTemplatesOption[$template] = Alexkova\Market\Core::getInstance()->getTemplateLessOption($template);

}

$templatesList = Alexkova\Market\Core::getInstance()->getSiteTemplates();
$templatesOption = array();
foreach ($templatesList as $template){
    	$templatesOption[$template] = Alexkova\Market\Core::getInstance()->getTemplateOption($template);
}
?>
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialchars($mid)?>&lang=<?=LANGUAGE_ID?>" enctype="multipart/form-data">
	<?$tabControl->Begin();?>
	<?$tabControl->BeginNextTab();?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("USE_MANAGMENT_MODE")?></td>
		<td valign="middle"><input type="checkbox" size="30" maxlength="255" value="Y" name="managment_mode" <?if ($managment_mode == "Y") echo 'checked="checked"'?>></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_MARKER_TYPE")?></td>
		<td valign="middle">
			<select name="list_marker_type">
				<option value=""><?=GetMessage('BXREADY_MARKER_TYPE')?></option>
				<?foreach($markerList as $cell=>$marker):?>
					<option value="<?=$cell?>" <?if ($list_marker_type == $cell) echo 'selected="selected"'?>><?=$marker?></option>
				<?endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXR_MIN_ORDER_PRICE")?></td>
		<td valign="middle"><input type="text" name="bxr_min_order_price" value="<?=$bxr_min_order_price?>"></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXR_MIN_ORDER_PRICE_MSG_OPT")?></td>
                <td valign="middle"><input type="text" name="bxr_min_order_price_msg" value="<?=$bxr_min_order_price_msg?>"></td>
	</tr>
        <tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_USE_LINKS_SKU")?></td>
		<td valign="middle"><input type="checkbox" size="30" maxlength="255" value="Y" name="bxr_use_links_sku" <?if ($bxr_use_links_sku == "Y") echo 'checked="checked"'?>></td>
	</tr>
        <tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SELECT_FIRST_SKU")?></td>
		<td valign="middle"><input type="checkbox" size="30" maxlength="255" value="Y" name="bxr_select_first_sku" <?if ($bxr_select_first_sku == "Y") echo 'checked="checked"'?>></td>
	</tr>
        <tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SELECT_RATIO")?></td>
		<td valign="middle">
                    <select name="ratio_settings">
                        <option value="none" <?if ($ratio_settings == "none") echo 'selected="selected"'?>><?=GetMessage('BXREADY_RATIO_NONE')?></option>
                        <option value="base" <?if ($ratio_settings == "base") echo 'selected="selected"'?>><?=GetMessage('BXREADY_RATIO_BASE')?></option>
                        <option value="own_prop" <?if ($ratio_settings == "own_prop") echo 'selected="selected"'?>><?=GetMessage('BXREADY_RATIO_OWN_PROP')?></option>
                    </select>
                </td>
	</tr>
        <tr class="personal-ratio-mode"<?if ($ratio_settings != "own_prop") {?> style="display:none"<?}?>>
		<td valign="top" width="40%"><?=GetMessage("BXR_RATIO_PROP_CODE")?></td>
		<td valign="middle"><input type="text" name="bxr_ratio_prop_code" value="<?=$bxr_ratio_prop_code?>"></td>
	</tr>

        <?$tabControl->BeginNextTab();?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("USE_MANAGMENT_ELEMENT_MODE")?></td>
		<td valign="middle"><input type="checkbox" size="30" maxlength="255" value="Y" name="managment_element_mode" <?if ($managment_element_mode == "Y") echo 'checked="checked"'?>></td>
	</tr>

        <tr class="only-managment-element-mode" <?if ($managment_element_mode != "Y") {?>style="display: none;"<?}?>>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SELECT_TEMPLATE")?></td>
		<td valign="middle"><select id="bxr_template_id" name="bxr_template_id">
			<option value=""></option>
			<?foreach($templatesList as $template):?>
				<option value="<?=$template?>" <?if($bxr_template_id == $template) echo 'selected="selected"'?>><?=$template?></option>
			<?endforeach;?>
		</select></td>
	</tr>
        <?foreach($templatesList as $template):?>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                <th colspan="2"><?=GetMessage("CARD_VIEW_CATALOG")?></th>
            </tr>
            <!--<tr class="only-managment-element-mode" <? //if ($managment_element_mode != "Y") {?>style="display: none;"<? //}?>>-->
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_GRID")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_type_<?=$template?>">
                                    <option value=""><?=GetMessage('BXREADY_ELEMENT_TYPE')?></option>
                                    <?foreach($elementGrid as $cell=>$element):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_type"] == $cell) echo 'selected="selected"'?>><?=$element?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_GRID_OWN")?></td>
                    <td valign="middle">
                        <input type="text" name="own_catalog_list_element_type_<?=$template?>" value="<?=$templatesOption[$template]["own_catalog_list_element_type"]?>">
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_LIST")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_type_list_<?=$template?>">
                                    <option value=""><?=GetMessage('BXREADY_ELEMENT_TYPE')?></option>
                                    <?foreach($elementList as $cell=>$element):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_type_list"] == $cell) echo 'selected="selected"'?>><?=$element?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_LIST_OWN")?></td>
                    <td valign="middle">
                        <input type="text" name="own_catalog_list_element_type_list_<?=$template?>" value="<?=$templatesOption[$template]["own_catalog_list_element_type_list"]?>">
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_TABLE")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_type_table_<?=$template?>">
                                    <option value=""><?=GetMessage('BXREADY_ELEMENT_TYPE')?></option>
                                    <?foreach($elementTable as $cell=>$element):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_type_table"] == $cell) echo 'selected="selected"'?>><?=$element?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_TABLE_OWN")?></td>
                    <td valign="middle">
                        <input type="text" name="own_catalog_list_element_type_table_<?=$template?>" value="<?=$templatesOption[$template]["own_catalog_list_element_type_table"]?>">
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                <th colspan="2"><?=GetMessage("BXREADY_CATALOG_ADAPTIVE")?></th>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_CATALOG_ADAPTIVE_LG")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_count_lg_<?=$template?>">
                                    <?foreach($elementListCount12 as $cell=>$elementCount):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_count_lg"] == $cell) echo 'selected="selected"'?>><?=$elementCount?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_CATALOG_ADAPTIVE_MD")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_count_md_<?=$template?>">
                                    <?foreach($elementListCount12 as $cell=>$elementCount):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_count_md"] == $cell) echo 'selected="selected"'?>><?=$elementCount?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_CATALOG_ADAPTIVE_SM")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_count_sm_<?=$template?>">
                                    <?foreach($elementListCount12 as $cell=>$elementCount):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_count_sm"] == $cell) echo 'selected="selected"'?>><?=$elementCount?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_CATALOG_ADAPTIVE_XS")?></td>
                    <td valign="middle">
                            <select name="catalog_list_element_count_xs_<?=$template?>">
                                    <?foreach($elementListCount12 as $cell=>$elementCount):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["catalog_list_element_count_xs"] == $cell) echo 'selected="selected"'?>><?=$elementCount?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                <th colspan="2"><?=GetMessage("CARD_VIEW_OTHERS")?></th>
            </tr>

            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_GRID")?></td>
                    <td valign="middle">
                            <select name="list_element_type_<?=$template?>">
                                    <option value=""><?=GetMessage('BXREADY_ELEMENT_TYPE')?></option>
                                    <?foreach($elementGrid as $cell=>$element):?>
                                            <option value="<?=$cell?>" <?if ($templatesOption[$template]["list_element_type"] == $cell) echo 'selected="selected"'?>><?=$element?></option>
                                    <?endforeach;?>
                            </select>
                    </td>
            </tr>
            <tr class="only-managment-element-mode bxr_templates bxr_template_<?=$template?>" style="display:none">
                    <td valign="top" width="40%"><?=GetMessage("BXREADY_LIST_ELEMENT_TYPE_GRID_OWN")?></td>
                    <td valign="middle">
                        <input type="text" name="own_list_element_type_<?=$template?>" value="<?=$templatesOption[$template]["own_list_element_type"]?>">
                    </td>
            </tr>
        <?endforeach;?>

	<?$tabControl->BeginNextTab();?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_TOP_BANNER_SETTINGS")?></td>
		<td valign="middle">
			<select name="bxr_market_top_banner">
				<option value="DISABLE" <?if($bxr_market_top_banner == "DISABLE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_DISABLE')?></option>
				<option value="FIXED" <?if($bxr_market_top_banner == "FIXED") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_FIXED')?></option>
				<option value="RESPONSIVE" <?if($bxr_market_top_banner == "RESPONSIVE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_RESPONSIVE')?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_BOTTOM_BANNER_SETTINGS")?></td>
		<td valign="middle">
			<select name="bxr_market_bottom_banner">
				<option value="DISABLE" <?if($bxr_market_bottom_banner == "DISABLE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_DISABLE')?></option>
				<option value="FIXED" <?if($bxr_market_bottom_banner == "FIXED") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_FIXED')?></option>
				<option value="RESPONSIVE" <?if($bxr_market_bottom_banner == "RESPONSIVE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_RESPONSIVE')?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_CATALOG_TOP_BANNER_SETTINGS")?></td>
		<td valign="middle">
			<select name="bxr_market_catalog_top_banner">
				<option value="DISABLE" <?if($bxr_market_catalog_top_banner == "DISABLE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_DISABLE')?></option>
				<option value="FIXED" <?if($bxr_market_catalog_top_banner == "FIXED") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_FIXED')?></option>
				<option value="RESPONSIVE" <?if($bxr_market_catalog_top_banner == "RESPONSIVE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_RESPONSIVE')?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_CATALOG_BOTTOM_BANNER_SETTINGS")?></td>
		<td valign="middle">
			<select name="bxr_market_catalog_bottom_banner">
				<option value="DISABLE" <?if($bxr_market_catalog_bottom_banner == "DISABLE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_DISABLE')?></option>
				<option value="FIXED" <?if($bxr_market_catalog_bottom_banner == "FIXED") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_FIXED')?></option>
				<option value="RESPONSIVE" <?if($bxr_market_catalog_bottom_banner == "RESPONSIVE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_RESPONSIVE')?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_LEFT_BANNER_SETTINGS")?></td>
		<td valign="middle">
			<select name="bxr_market_left_banner">
				<option value="DISABLE" <?if($bxr_market_left_banner == "DISABLE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_DISABLE')?></option>
				<option value="FIXED" <?if($bxr_market_left_banner == "FIXED") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_FIXED')?></option>
				<option value="RESPONSIVE" <?if($bxr_market_left_banner == "RESPONSIVE") echo 'selected="selected"'?>><?=GetMessage('BXREADY_BANNER_SETTINGS_VALUE_RESPONSIVE')?></option>
			</select>
		</td>
	</tr>



	<!--<tr class="only-managment-mode" <?=$managment_mode_display?>>
		<td valign="top" width="40%"><?=GetMessage("RK_STAT_DAYS")?></td>
		<td valign="middle"><input type="text" size="30" maxlength="255" value="<?=$STAT_DAYS?>" name="STAT_DAYS"></td>
	</tr>

	<tr class="only-managment-mode" <?=$managment_mode_display?>>
		<td valign="top" width="40%"><?=GetMessage("RK_STAT_DELAY_TIME")?></td>
		<td valign="middle"><input type="text" size="30" maxlength="255" value="<?=$STAT_DELAY_TIME?>" name="STAT_DELAY_TIME"></td>
	</tr>-->

	<?$tabControl->BeginNextTab();?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SELECT_TEMPLATE")?></td>
		<td valign="middle"><select id="bxr_less_template_id" name="bxr_less_template_id">
			<option value=""></option>
			<?foreach($lessTemplatesList as $template):?>
				<option value="<?=$template?>" <?if($bxr_less_template_id == $template) echo 'selected="selected"'?>><?=$template?></option>
			<?endforeach;?>
		</select></td>
	</tr>

	<?foreach($lessTemplatesList as $template):?>
		<tr class="bxr_templates bxr_template_<?=$template?>" style="display:none">
			<td valign="top" width="40%"><?=GetMessage("BXREADY_LESS_BASE_COLOR")?></td>
			<td valign="middle">
				<input type="text" name="bxr_less_base_color_<?=$template?>" id="color-base-<?=$template?>" value="<?=$lessTemplatesOption[$template]["base"]?>">
			</td>
		</tr>
	<?endforeach;?>

	<?foreach($lessTemplatesList as $template):?>
		<tr class="bxr_templates bxr_template_<?=$template?>" style="display:none">
			<td valign="top" width="40%"><?=GetMessage("BXREADY_LESS_DARKEN_COLOR")?></td>
			<td valign="middle">
				<div id="less-darken-<?=$template?>"></div>
				<input type="text" name="bxr_less_darken_<?=$template?>" value="<?=$lessTemplatesOption[$template]["stepdark"]?>" id="less-darken-<?=$template?>-val" readonly style="border:0; color:#900; font-weight:bold; font-size: 20px">
			</td>
		</tr>
	<?endforeach;?>

	<?foreach($lessTemplatesList as $template):?>
		<tr class="bxr_templates bxr_template_<?=$template?>" style="display:none">
			<td valign="top" width="40%"><?=GetMessage("BXREADY_LESS_LIGHTEN_COLOR")?></td>
			<td valign="middle">
				<div id="less-lighten-<?=$template?>"></div>
				<input type="text" name="bxr_less_lighten_<?=$template?>" value="<?=$lessTemplatesOption[$template]["steplight"]?>" id="less-lighten-<?=$template?>-val" readonly style="border:0; color:#900; font-weight:bold; font-size: 20px">
			</td>
		</tr>
	<?endforeach;?>

	<?$tabControl->BeginNextTab();?>
	<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>

	<?$tabControl->BeginNextTab();?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_NAME")?>:</td>
		<td valign="middle"><input type="text" name="bxr_org_name" value="<?=$bxr_org_name?>" /></td>
	</tr>
	<tr>
		<td width="40%" align="right"><?=GetMessage("BXREADY_SCHEMA_ORG_LOGO")?>:</td>
		<td width="60%">
			<?echo CFile::InputFile("bxr_org_logo", 20, $bxr_org_logo);?><br>
			<?echo CFile::ShowImage($bxr_org_logo, 200, 200, "border=0", "", true)?>
		</td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_OPENGRAPH")?>:</td>
		<td valign="middle"><input type="checkbox" size="30" maxlength="255" value="Y" name="bxr_org_opengraph" <?if ($bxr_org_opengraph == "Y") echo 'checked="checked"'?>></td>
	</tr>
<?/*	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_TYPE")?>:</td>
		<td valign="middle"><select></select></td>
	</tr>*/?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_DESCRIPTION")?>:</td>
		<td valign="middle"><textarea name="bxr_org_description"><?=$bxr_org_description?></textarea></td>
	</tr>
	<tr class="heading">
		<td colspan="2"><b><?=GetMessage("BXREADY_SCHEMA_ORG_CONTACTS")?></b></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_PHONE")?>:</td>
		<td valign="middle"><input type="text" name="bxr_org_phone" value="<?=$bxr_org_phone?>" /></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_FAX")?>:</td>
		<td valign="middle"><input type="text" name="bxr_org_fax" value="<?=$bxr_org_fax?>" /></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_EMAIL")?>:</td>
		<td valign="middle"><input type="text" name="bxr_org_email" value="<?=$bxr_org_email?>" /></td>
	</tr>
	<tr class="heading">
		<td colspan="2"><b><?=GetMessage("BXREADY_SCHEMA_ORG_ADDRESS")?></b></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_CITY")?>:</td>
		<td valign="middle"><input type="text" name="bxr_org_address_city" value="<?=$bxr_org_address_city?>" /></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_ZIP")?>:</td>
		<td valign="middle"><input type="text" name="bxr_org_address_zip" value="<?=$bxr_org_address_zip?>" /></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_SCHEMA_ORG_STREET")?>:</td>
		<td valign="middle"><textarea name="bxr_org_address_street"><?=$bxr_org_address_street?></textarea></td>
	</tr>

        <?$tabControl->BeginNextTab();?>
        <tr>
		<td valign="top" width="40%"><?=GetMessage("BXREADY_PRICE_TYPE")?></td>
		<td valign="middle">
			<select multiple="multiple" name="list_price_type[]">
				<?foreach($arPrice as $cell=>$price):?>
					<option value="<?=$cell?>" <?if (empty($list_price_type) || in_array($cell, $list_price_type)) echo 'selected="selected"'?>><?=$price?></option>
				<?endforeach;?>
			</select>
		</td>
	</tr>


	<?$tabControl->Buttons();?>
	<script>
		function RestoreDefaults()
		{
			if(confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>'))
				window.location = "<?echo $APPLICATION->GetCurPage()?>?RestoreDefaults=Y&lang=<?=LANGUAGE_ID?>&mid=<?echo urlencode($mid)?>&<?echo bitrix_sessid_get()?>";
		}
	</script>
	<?if(strlen($_REQUEST["back_url_settings"])>0):?>
		<input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>"<?if ($RK_RIGHT<"W") echo " disabled" ?>>
	<?endif?>
	<input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>"<?if ($RK_RIGHT<"W") echo " disabled" ?>>
	<?if(strlen($_REQUEST["back_url_settings"])>0):?>
		<input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialchars(CUtil::JSEscape($_REQUEST["back_url_settings"]))?>'">
		<input type="hidden" name="back_url_settings" value="<?=htmlspecialchars($_REQUEST["back_url_settings"])?>">
	<?endif?>
	<input type="button" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="RestoreDefaults();" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>"<?if ($RK_RIGHT<"W") echo " disabled" ?>>
	<?=bitrix_sessid_post();?>

	<?$tabControl->End();?>
</form>
<?
$APPLICATION->AddHeadScript('/bitrix/tools/bxready.market/spectrum/spectrum.js');
$APPLICATION->SetAdditionalCSS('/bitrix/tools/bxready.market/spectrum/spectrum.css');
$APPLICATION->AddHeadScript('/bitrix/tools/bxready.market/ui/jquery-ui.js');
$APPLICATION->SetAdditionalCSS('/bitrix/tools/bxready.market/ui/jquery-ui.css');
?>

<script>

	$(document).ready(function(){
		$(document).on(
			'change',
			'input[name=managment_mode]',
			function(){
				if ($('input[name=managment_mode]').attr('checked') == "checked"){
					$('.only-managment-mode').css('display', 'table-row');
				}else{
					$('.only-managment-mode').css('display', 'none');
				}
			}
		);

                $(document).on(
			'change',
			'select[name=ratio_settings]',
			function(){
				if ($('select[name=ratio_settings]').val() == "own_prop"){
					$('.personal-ratio-mode').css('display', 'table-row');
				}else{
					$('.personal-ratio-mode').css('display', 'none');
				}
			}
		);

                $(document).on(
			'change',
			'input[name=managment_element_mode]',
			function(){
				if ($('input[name=managment_element_mode]').attr('checked') == "checked"){
					$('.only-managment-element-mode').css('display', 'table-row');
                                        $('#bxr_template_id').trigger('change');
				}else{
					$('.only-managment-element-mode').css('display', 'none');
				}
			}
		);

		$(document).on(
			'change',
			'#bxr_less_template_id',
			function(){

				$('.bxr_templates').hide();
				$('.bxr_template_'+$(this).val()).show();
			}
		);

                $(document).on(
			'change',
			'#bxr_template_id',
			function(){

				$('.bxr_templates').hide();
				$('.bxr_template_'+$(this).val()).show();
			}
		);

	});

	<?foreach($lessTemplatesList as $template):?>
		$("#color-base-<?=$template?>").spectrum({
			preferredFormat: "hex",
			showInput: true,
			showPalette: true,
			palette: [["#f44336", "#ff5722", "#e78733", "#ff9800", "#ffad00"], ["#ffc107", "#ffeb3b", "#cddc39", "#8bc34a", "#9ac130"], ["#4caf50", "#41ae86", "#009688", "#0f7e55", "#0f8c98"], ["#00bcd4", "#03a9f4", "#2196f3", "#0f7eda", "#3f51b5"], ["#673ab7", "#9c27b0", "#e91e63", "#9e9e9e", "#777777"], ["#607d8b", "#455968", "#3e464c", "#945a45", "#795548"]],
			change: function(color) {
				$("#color-base-<?=$template?>").val(color.toHexString());
			}
		});

		$("#less-darken-<?=$template?>").slider({
			value:<?=$lessTemplatesOption[$template]["stepdark"]>0?$lessTemplatesOption[$template]["stepdark"]:20?>,
			min: 0,
			max: 100,
			step: 5,
			slide: function( event, ui ) {
				$( "#less-darken-<?=$template?>-val" ).val( ui.value);
			}
		});
	$( "#less-darken-<?=$template?>-val" ).val( $( "#less-darken-<?=$template?>" ).slider( "value" ) );

	$("#less-lighten-<?=$template?>").slider({
		value:<?=$lessTemplatesOption[$template]["steplight"]>0?$lessTemplatesOption[$template]["steplight"]:20?>,
		min: 0,
		max: 100,
		step: 5,
		slide: function( event, ui ) {
			$( "#less-lighten-<?=$template?>-val" ).val( ui.value);
		}
	});
	$( "#less-lighten-<?=$template?>-val" ).val( $( "#less-lighten-<?=$template?>" ).slider( "value" ));
	<?endforeach;?>



</script>