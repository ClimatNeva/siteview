<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"){
	?><div class="search-close-container"></div><?
	?><div class="top-search clearfix" id="<?echo $CONTAINER_ID?>"><?
	?><form action="<?echo $arResult["FORM_ACTION"]?>" class="search-form site-form no-ajax"><?
            ?><input id="<?echo $INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off"  required data-msg-required="<?=GetMessage('ERROR_MESSAGE_EMPTY_SEARCH')?>" placeholder="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" /><?
            ?><label class="submit submit-search" title="Искать"><?
				?><input name="s" type="submit" value="<?=GetMessage("CT_BST_SEARCH_BUTTON");?>" /><?
				?><div class="search-submit"></div><?
                /*?><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><?
				?><path d="M11.7406 10.3281C12.5281 9.25313 13 7.93125 13 6.5C13 2.91563 10.0844 0 6.5 0C2.91563 0 0 2.91563 0 6.5C0 10.0844 2.91563 13 6.5 13C7.93125 13 9.25313 12.5281 10.3281 11.7406L14.5875 16L16 14.5875C16 14.5844 11.7406 10.3281 11.7406 10.3281ZM6.5 11C4.01875 11 2 8.98125 2 6.5C2 4.01875 4.01875 2 6.5 2C8.98125 2 11 4.01875 11 6.5C11 8.98125 8.98125 11 6.5 11Z" fill="#2A4C6B"/><?
				?></svg><?*/
            ?></label><?
	?></form><?
    ?></div><?
}
?><script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
