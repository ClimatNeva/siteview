<?
$module_id = "alexkova.popupad";
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$module_id."/include.php");
IncludeModuleLangFile(__FILE__);

$RK_RIGHT = $APPLICATION->GetGroupRight($module_id);
$aTabs = array(
	array("DIV" => "edit1", "TAB" => GetMessage("POPUPAD_OPTIONS"), "TITLE" => GetMessage("POPUPAD_OPTIONS_TITLE")),
	array("DIV" => "edit2", "TAB" => GetMessage("POPUPAD_ACCESS"), "TITLE" => GetMessage("POPUPAD_ACCESS_TITLE")),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);
if ($REQUEST_METHOD=="GET" && $RK_RIGHT=="W" && strlen($RestoreDefaults)>0 && check_bitrix_sessid())
{
	CKuznicaPopupadGeneral::ResetBannersLeftCount();
	foreach($_COOKIE as $cookieName=>$cookie){
		if (substr_count($cookieName, 'KZNC_BANER_ID_SHOWN_')) {
			unset($_COOKIE[$cookieName]);
			setcookie($cookieName, null, -1, '/');
		}
	}
	unset($_COOKIE["KZNC_PROTECT_BANER_SHOW_TIME"]);
	setcookie('KZNC_PROTECT_BANER_SHOW_TIME', null, -1, '/');

	COption::RemoveOption($module_id);

	COption::SetOptionString($module_id, "POPUP_PROTECTION_TIMER", 1800);
	COption::SetOptionString($module_id, "POPUP_JQUERY", 0);
	COption::SetOptionString($module_id, "POPUP_VERSION_2_ON", 1);
	COption::SetOptionString($module_id, "POPUP_FANCYBOX", 1);
	COption::SetOptionString($module_id, "POPUP_FANCYBOX_OVERLAY", 0);
	COption::SetOptionString($module_id, "POPUP_TIME_DELAY_SHOW", 0);

	$z = CGroup::GetList($v1="id",$v2="asc", array("ACTIVE" => "Y", "ADMIN" => "N"));
	while($zr = $z->Fetch())
		$APPLICATION->DelGroupRight($module_id, array($zr["ID"]));
}
if($REQUEST_METHOD=="POST" && strlen($Update.$Apply)>0 && $RK_RIGHT>="W" && check_bitrix_sessid())
{
	$POPUP_HIDE_FANCY_OLD = COption::GetOptionString($module_id, "POPUP_HIDE_FANCY", '');
	$POPUP_HIDE_ICON_OLD = COption::GetOptionString($module_id, "POPUP_HIDE_ICON", '');
	if($POPUP_HIDE_FANCY_OLD != $POPUP_HIDE_FANCY || $POPUP_HIDE_ICON_OLD != $POPUP_HIDE_ICON)
		CKuznicaPopupadGeneral::ResetBannersLeftCount();


	unset($_COOKIE["KZNC_PROTECT_BANER_SHOW_TIME"]);
	setcookie('KZNC_PROTECT_BANER_SHOW_TIME', null, -1, '/');

	COption::SetOptionString($module_id, "POPUP_PROTECTION_TIMER", $POPUP_PROTECTION_TIMER);
	COption::SetOptionString($module_id, "POPUP_HIDE_FANCY", $POPUP_HIDE_FANCY);
	COption::SetOptionString($module_id, "POPUP_HIDE_ICON", $POPUP_HIDE_ICON);

	if ($POPUP_FANCYBOX){
		COption::SetOptionString($module_id, "POPUP_FANCYBOX", 1);
	}else{
		COption::SetOptionString($module_id, "POPUP_FANCYBOX", 0);
	}
	if ($POPUP_VERSION_2_ON){
		COption::SetOptionString($module_id, "POPUP_VERSION_2_ON", 1);
	}else{
		COption::SetOptionString($module_id, "POPUP_VERSION_2_ON", 0);
	}
	if ($POPUP_FANCYBOX_OVERLAY){
		COption::SetOptionString($module_id, "POPUP_FANCYBOX_OVERLAY", 1);
	}else{
		COption::SetOptionString($module_id, "POPUP_FANCYBOX_OVERLAY", 0);
	}

	if ($POPUP_JQUERY){
		COption::SetOptionString($module_id, "POPUP_JQUERY", 1);
	}else{
		COption::SetOptionString($module_id, "POPUP_JQUERY", 0);
	}

	COption::SetOptionString($module_id, "POPUP_TIME_DELAY_SHOW", $POPUP_TIME_DELAY_SHOW);

	$Update = $Update.$Apply;
	ob_start();
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
	ob_end_clean();

	if($Apply == '' && $_REQUEST["back_url_settings"] <> '')
		LocalRedirect($_REQUEST["back_url_settings"]);
	else
		LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());

}
$POPUP_PROTECTION_TIMER = COption::GetOptionString($module_id, "POPUP_PROTECTION_TIMER", 1800);
$POPUP_JQUERY = COption::GetOptionString($module_id, "POPUP_JQUERY", 0);
$POPUP_FANCYBOX = COption::GetOptionString($module_id, "POPUP_FANCYBOX", 1);
$POPUP_FANCYBOX_OVERLAY = COption::GetOptionString($module_id, "POPUP_FANCYBOX_OVERLAY", 0);
$POPUP_TIME_DELAY_SHOW = COption::GetOptionString($module_id, "POPUP_TIME_DELAY_SHOW", 0);
$POPUP_HIDE_FANCY = COption::GetOptionString($module_id, "POPUP_HIDE_FANCY", '');
$POPUP_VERSION_2_ON = COption::GetOptionString($module_id, "POPUP_VERSION_2_ON", 0);
$POPUP_HIDE_ICON = COption::GetOptionString($module_id, "POPUP_HIDE_ICON", '');
?>
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialchars($mid)?>&lang=<?=LANGUAGE_ID?>">
<?$tabControl->Begin();?>
<?$tabControl->BeginNextTab();?>
	<tr class="heading">
		<td colspan="2"><b><?=GetMessage('POPUPAD_MAIN_OPTION')?></b></td>
	</tr>
	<tr>
		 <td width="40%"><label for="POPUP_VERSION_2_ON"><?=GetMessage("POPUP_VERSION_2_ON")?></label>:</td>
		 <td width="60%">
             <input name="POPUP_VERSION_2_ON" type="checkbox" id="POPUP_VERSION_2_ON" <?=($POPUP_VERSION_2_ON) ? 'checked="checked"' : ''?> />
         </td>
	</tr>
	<tr>
		 <td width="40%"><label for="POPUP_HIDE_FANCY"><?=GetMessage("POPUP_HIDE_FANCY")?></label>:</td>
		 <td width="60%">
			 <?echo InputType("checkbox", "POPUP_HIDE_FANCY", "Y", $POPUP_HIDE_FANCY, false);?>
		 </td>
	</tr>
	<tr>
		 <td width="40%"><label for="POPUP_HIDE_ICON"><?=GetMessage("POPUP_HIDE_ICON")?></label>:</td>
		 <td width="60%">
			 <?echo InputType("checkbox", "POPUP_HIDE_ICON", "Y", $POPUP_HIDE_ICON, false);?>
		 </td>
	</tr>
	<tr>
		 <td width="40%"><?=GetMessage("POPUP_PROTECTION_TIMER_TITLE")?>:</td>
		 <td width="60%">
			<input name="POPUP_PROTECTION_TIMER" type="text" id="POPUP_PROTECTION_TIMER" value="<?=$POPUP_PROTECTION_TIMER?>"/><?=GetMessage("SECONDS")?>
		 </td>
	</tr>
	<tr>
		 <td width="40%"><?=GetMessage("POPUP_TIME_DELAY_SHOW")?>:</td>
		 <td width="60%">
			<input name="POPUP_TIME_DELAY_SHOW" type="text" id="POPUP_TIME_DELAY_SHOW" value="<?=$POPUP_TIME_DELAY_SHOW?>"/><?=GetMessage("SECONDS")?>
		 </td>
	</tr>
	<tr>
		 <td width="40%"><label for="POPUP_JQUERY"><?=GetMessage("POPUP_JQUERY")?></label>:</td>
		 <td width="60%">
			<input name="POPUP_JQUERY" type="checkbox" id="POPUP_JQUERY" <?=($POPUP_JQUERY) ? 'checked="checked"' : ''?> />
		 </td>
	</tr>
	<tr>
		 <td width="40%"><label for="POPUP_FANCYBOX"><?=GetMessage("POPUP_FANCYBOX")?></label>:</td>
		 <td width="60%">
			<input name="POPUP_FANCYBOX" type="checkbox" id="POPUP_FANCYBOX" <?=($POPUP_FANCYBOX) ? 'checked="checked"' : ''?> />
		 </td>
	</tr>
	<tr>
		 <td width="40%"><label for="POPUP_FANCYBOX"><?=GetMessage("POPUP_FANCYBOX_OVERLAY")?></label>:</td>
		 <td width="60%">
			<input name="POPUP_FANCYBOX_OVERLAY" type="checkbox" id="POPUP_FANCYBOX_OVERLAY" <?=($POPUP_FANCYBOX_OVERLAY) ? 'checked="checked"' : ''?> />
		 </td>
	</tr>
<?$tabControl->BeginNextTab();?>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
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