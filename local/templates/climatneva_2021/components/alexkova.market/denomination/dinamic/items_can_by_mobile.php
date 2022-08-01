<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["BASKET_ITEMS"]["CAN_BUY"])>0){?>
	<div class="basket-body-table">
		<?foreach($arResult["BASKET_ITEMS"]["CAN_BUY"] as $arBasketItem):

			$img = $arBasketItem["PICTURE"];
			$img = (strlen($img)>0)
				? '<a href="'.$arBasketItem["URL"].'"
						style="background: url('.$img.') no-repeat center center;
						background-size: contain;
						"></a>'
				: " ";
			?>
			<div class="basket-body-table-row">
				<table width="100%">
					<tr>
						<td class="basket-image first">
							<?=$img?>
							<?if ($img){?>
							<?}else{?>
							<?}?>
						</td>
						<td class="basket-name xs-hide"><a href="<?=$arBasketItem["URL"]?>" class="bxr-font-hover-light"><?=$arBasketItem["NAME"]?></a></td>
						<td class="basket-price bxr-format-price"><?=$arBasketItem["FORMAT_PRICE"]?><br><span class="bxr-market-current-price-denom"><?=CurrencyFormat($arBasketItem["PRICE"]*$denomination, $arBasketItem["CURRENCY"])?></span></td>
					</tr>
				</table>
				<table width="100%" class="bxr-table-row-action">
					<tr>
						<td class="basket-line-qty xs-hide sm-hide">
							<div class="bxr-basket-group">
								<input type="button" class="bxr-quantity-button-minus" value="-" data-item="<?=$arBasketItem["ID"]?>" data-operation="auto_save">
								<input type="text" value="<?=round($arBasketItem["QUANTITY"])?>" class="bxr-quantity-text" name="quantity" data-item="<?=$arBasketItem["ID"]?>">
								<input type="button" class="bxr-quantity-button-plus" value="+" data-item="<?=$arBasketItem["ID"]?>" data-operation="auto_save" data-max="0">
							</div>

						</td>
						<td class="basket-summ bxr-format-price"><?=$arBasketItem["FORMAT_SUMM"]?><br><span class="bxr-market-current-price-denom"><?=CurrencyFormat($arBasketItem["SUMM"]*$denomination, $arBasketItem["CURRENCY"])?></span></td>
						<td class="basket-action last">
							<button id="button-delay-<?=$arBasketItem["ID"]?>" class="icon-button-delay" value="" data-item="<?=$arBasketItem["ID"]?>">
								<span class="fa fa-bookmark-o" aria-hidden="true"></span>
							</button>
							<button id="button-delay-<?=$arBasketItem["ID"]?>" class="icon-button-delete" value="" data-item="<?=$arBasketItem["ID"]?>">
								<span class="fa fa-close" aria-hidden="true"></span>
							</button>

						</td>
					</tr>
				</table>
			</div>
		<?endforeach;?>
	</div>

	<div class="basket-body-title">
		<div class="pull-left">
			<button class="btn btn-default bxr-close-basket-mobile  bxr-color-button-small bxr-corns">
				<span class="fa fa-power-off" aria-hidden="true"></span>
				<?=GetMessage('BASKET_CLOSE')?></button>
		</div>
		<div class="pull-right">
			<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="bxr-color-button bxr-color-button-small">
				<span class="fa fa-check-square-o" aria-hidden="true"></span>
				<?=GetMessage('BASKET_TO_ORDER')?></a>
		</div>
	</div>

<?}else{?>
	<p class="bxr-helper bg-info">
		<?=GetMessage('BASKET_DROP_EMPTY')?>
	</p>
<?}?>
<div class="icon-close"></div>