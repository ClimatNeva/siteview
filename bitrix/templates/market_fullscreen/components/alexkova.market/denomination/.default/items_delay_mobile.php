<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["BASKET_ITEMS"]["DELAY"])>0){?>
	<div class="basket-body-table">
		<?foreach($arResult["BASKET_ITEMS"]["DELAY"] as $arBasketItem):

			$img = $arBasketItem["PICTURE"];
			$img = (strlen($img)>0)
				? '<a href="'.$arBasketItem["URL"].'"
						style="background: url('.$img.') no-repeat center center;
						background-size: contain;
						"></a>'
				: " ";
			?>
			<div class="basket-body-table-row">
				<table width="100%" class="bxr-table-row-action ">
					<tr>
						<td class="basket-image first">
							<?=$img?>
							<?if ($img){?>
							<?}else{?>
							<?}?>
						</td>
						<td class="basket-name xs-hide">
							<a href="<?=$arBasketItem["URL"]?>" class="bxr-font-hover-light"><?=$arBasketItem["NAME"]?>
							</a>
							<b class="basket-price"><?=$arBasketItem["FORMAT_PRICE"]?></b><br><span class="bxr-market-current-price-denom"><?=CurrencyFormat($arBasketItem["PRICE"]*$denomination, $arBasketItem["CURRENCY"])?></span>
						</td>
						<td class="basket-action last">
							<button id="button-delay-<?=$arBasketItem["ID"]?>" class="icon-button-cart" value="" data-item="<?=$arBasketItem["ID"]?>">
								<span class="fa fa-shopping-cart" aria-hidden="true"></span>
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
		<div class="pull-right">
			<button class="btn btn-default bxr-close-basket-mobile bxr-corns">
				<span class="fa fa-power-off" aria-hidden="true"></span>
				<?=GetMessage('BASKET_CLOSE')?></button>
		</div>
	</div>

<?}else{?>
	<p class="bxr-helper bg-info">
		<?=GetMessage('BASKET_DELAY_EMPTY')?>
	</p>
<?}?>
<div class="icon-close"></div>