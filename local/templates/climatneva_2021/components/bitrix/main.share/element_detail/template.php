<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);

if ($arResult["PAGE_URL"])
{
	if ($arParams["RESULT_AS_SCRIPT"]) {
		?>
<script>
var shareObject = <?=CUtil::PhpToJSObject(array_reverse($arResult["BOOKMARKS"]), false, true); ?>;
</script>
		<?
	} else {
	?>
<div class="bxr-share-icon-wrap">
	<ul class="bxr-share-social">
		<?
		if (is_array($arResult["BOOKMARKS"]) && count($arResult["BOOKMARKS"]) > 0)
		{
			foreach(array_reverse($arResult["BOOKMARKS"]) as $name => $arBookmark)
			{
				?><li class="bxr-share-icon"><?=$arBookmark["ICON"]?></li><?
			}
		}
		?>
	</ul>
</div>
	<?}
}
else
{
	?><?=GetMessage("SHARE_ERROR_EMPTY_SERVER")?><?
}
?>