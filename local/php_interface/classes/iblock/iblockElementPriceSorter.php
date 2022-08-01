<?
class iblockElementPriceSorter
{
    function OnAfterIBlockElementUpdateHandler(&$arFields) {
        $res = CPRice::GetList(array(),array("PRODUCT_ID"=>$arFields["ID"],"CATALOG_GROUP_ID"=>1));
		$PROP_VAL = 148;
        if ($arRes = $res->Fetch()) {
            if ($arRes["PRICE"]>0) {
            	$PROP_VAL = 149;
            }
        }
        CIBlockElement::SetPropertyValues($arFields["ID"], $arFields["IBLOCK_ID"], $PROP_VAL, "NOT2SHOW_PRICE_ABOVE_ZERO");
    }
}
?>