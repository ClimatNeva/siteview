<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
use Bitrix\Main\Entity,
    Bitrix\Highloadblock as HL,
    Bitrix\Highloadblock\HighloadBlockTable as HLBT;

CModule::IncludeModule('highloadblock');
CModule::IncludeModule('iblock');

$IBLOCK_ID = "12";
$HLBLOCK_ID = 2;
$arReplace = array("/mini VRF/","/VRF/","/J-II/","/MDV V5X/","/MDV/","/LG/","/MEGA/","/Lausanne/","/Davos/","/Geneva/","/Basel/","/Zurich/","/ELITE ONE/","/PROCOOL/",
        "/Mitsubishi Heavy Industrie/","/Kentatsu/","/LMV-Mini/","/LMV-IceCore Citadel/","/LMV-IceCore Submarine/","/LMV-IceCore Alliance/","/FRESH HOME/",
        "/Mitsubushi Electric/","/Mitsubishi Heavy/","/ARTCOOL Slim/","/Air handl.units/","/Air handl.unit/","/ETTORE/","/Plaza/"); // ,"//"
$arSymbol = "/[АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯабвгдеёжзийклмнопрстуфхцчшщьыъэюя]+/";

$arBrand = array();

$hlblock = HL\HighloadBlockTable::getById($HLBLOCK_ID)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$main_query = new Entity\Query($entity);
$main_query->setSelect(array('UF_XML_ID','UF_NAME'));
$result = $main_query->exec();
$result = new CDBResult($result);
while ($row = $result->Fetch()){
        $arBrand[$row['UF_XML_ID']] = $row['UF_NAME'];
}
echo "<pre>",print_r($arBrand),"</pre>";

$res = CIBlockElement::GetList(array(),array("IBLOCK_ID" => $IBLOCK_ID),false,false,array("ID","NAME","PROPERTY_MANUFACTURER"));
while ($row = $res->GetNext()) {
        echo "<pre>",$row["NAME"],"\n";
        $newName = preg_replace($arSymbol,'',$row["NAME"]);
        $findPos = strpos(strtolower($newName), strtolower($arBrand[$row["PROPERTY_MANUFACTURER_VALUE"]]));
        if ($findPos !== false)
                $newName = substr_replace($newName, '', $findPos, strlen($arBrand[$row["PROPERTY_MANUFACTURER_VALUE"]]));
        $newName = preg_replace($arReplace, '', $newName);
        $newName = trim($newName);
        $newName = trim($newName,'-');
        $newName = trim($newName);
        $newName = preg_replace('/ +/',' ',$newName);
        if ($newName == '201680490996 3- MDKH/MDKF') continue;
        if (strlen($newName) > 0) {
                CIBlockElement::SetPropertyValuesEx($row["ID"],$IBLOCK_ID,array("VENDOR_CODE" => $newName));
                echo "newName: ",$newName,"\n";
        }
        echo "</pre>";
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?/*

(
    [UF_XML_ID] => fujitsu
    [UF_NAME] => FUJITSU
)
(
    [ID] => 705
    [~ID] => 705
    [NAME] => MDV-V260W/DRN1 Наружный блок mini VRF системы MDV
    [~NAME] => MDV-V260W/DRN1 Наружный блок mini VRF системы MDV
    [PROPERTY_MANUFACTURER_VALUE] => mdv
    [~PROPERTY_MANUFACTURER_VALUE] => mdv
    [PROPERTY_MANUFACTURER_VALUE_ID] => 2193
    [~PROPERTY_MANUFACTURER_VALUE_ID] => 2193
)

CModule::IncludeModule('iblock');

$arParams["IBLOCK_ID"] = 19;

if(is_numeric($arParams["IBLOCK_ID"]))
{
        $rsIBlock = CIBlock::GetList(array(), array(
                "ACTIVE" => "Y",
                "ID" => $arParams["IBLOCK_ID"],
        ));
}
else
{
        $rsIBlock = CIBlock::GetList(array(), array(
                "ACTIVE" => "Y",
                "CODE" => $arParams["IBLOCK_ID"],
                "SITE_ID" => SITE_ID,
        ));
}

if ($arResult = $rsIBlock->GetNext())
    echo "<pre>",print_r($arResult),"</pre>";
else
    echo "<pre>Break</pre>";
*/
?>
