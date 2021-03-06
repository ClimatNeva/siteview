<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$denomination = 10000;?>
<?if (count($arResult["BASKET_ITEMS"]["DELAY"])>0){?>
<div class="basket-body-table">
	<table width="100%">
		<tr>
			<th class="first"> </th>
			<th><?=GetMessage('BASKET_TD_NAME')?></th>
			<th><?=GetMessage('BASKET_TD_PRICE')?></th>
			<th class="last"> </th>
		</tr>
		<?foreach($arResult["BASKET_ITEMS"]["DELAY"] as $arBasketItem):

			$img = $arBasketItem["PICTURE"];
			$img = (strlen($img)>0)
				? '<a href="'.$arBasketItem["URL"].'"
						style="background: url('.$img.') no-repeat center center;
						background-size: contain;
						"></a>'
				: " ";
			?>
			<tr>
				<td class="basket-image first">
					<?=$img?>
					<?if ($img){?>
					<?}else{?>
					<?}?>
				</td>
				<td class="basket-name xs-hide"><a href="<?=$arBasketItem["URL"]?>" class="bxr-font-hover-light"><?=$arBasketItem["NAME"]?></a></td>
				<td class="basket-price bxr-format-price"><?=$arBasketItem["FORMAT_PRICE"]?><br><span class="bxr-market-current-price-denom"><?=CurrencyFormat($arBasketItem["PRICE"]*$denomination, $arBasketItem["CURRENCY"])?></span></td>
				<td class="basket-action last">
					<button id="button-delay-<?=$arBasketItem["ID"]?>" class="icon-button-cart" value="" data-item="<?=$arBasketItem["ID"]?>">
						<span class="fa fa-shopping-cart" aria-hidden="true"></span>
					</button>
					<button id="button-delay-<?=$arBasketItem["ID"]?>" class="icon-button-delete" value="" data-item="<?=$arBasketItem["ID"]?>">
						<span class="fa fa-close" aria-hidden="true"></span>
					</button>

				</td>
			</tr>
		<?endforeach;?>
	</table>
</div>
	<div class="basket-body-title">
		<div class="pull-right">
			<a href="<?=$arParams["PATH_TO_BASKET"]?>"  class="bxr-color-button">
				<span class="fa fa-shopping-cart" aria-hidden="true"></span>
				<?=GetMessage('SHOW_BASKET')?></a>
		</div>
	</div>


<?}else{?>
	<p class="bxr-helper bg-info">
		<?=GetMessage('BASKET_DELAY_EMPTY')?>
	</p>
<?}?>
<div class="icon-close"></div>