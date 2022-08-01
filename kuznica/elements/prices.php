<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/ps_hardevel_multicurrency.csv';
$catalogIblockId = 12;

$stringNumber = 100;
$numberImportingStrings = 50;

$curIds = array(
    1 => "RUB",
    2 => "USD",
    3 => "EUR"
);

if (($handle_f = fopen($file_name, "r")) !== FALSE)
{
    if(isset($_GET['ftell']))
        fseek($handle_f,$_GET['ftell']);
    
    $i=0;
    
    if(isset($_GET['x']))
        $x=$_GET['x'];
    else 
        $x = 0;

    while (($data_f = fgetcsv($handle_f, 10000, "|||"))!== FALSE) 
    {                    
        echo '<pre>';print_r($data_f);echo '</pre>';
        
        $PRODUCT_ID = 0;
        $PRICE_TYPE_ID = 1;
        $xml = 'prod_'.$data_f[3];
        $cur_id = $data_f[9];
        $cur_code = $curIds[$cur_id];
        $price = trim($data_f[12]);
                
        $arFilterElem = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID'=>$xml);
        $resElem = CIBlockElement::GetList(Array(), $arFilterElem, false, Array(), array('ID','XML_ID'));
        if($ob = $resElem->GetNext())
        {
            $PRODUCT_ID = $ob['ID'];
            
            $arFieldsCatalog = array(
                "ID" => $PRODUCT_ID,
                "CAN_BUY_ZERO" => "D"
            );
            if(CCatalogProduct::Add($arFieldsCatalog))
                echo "Добавили параметры товара к элементу каталога ".$PRODUCT_ID.'<br>';
            else
                echo $data_f[3].'- Ошибка добавления параметров<br>';

            $arFields = Array(
                "PRODUCT_ID" => $PRODUCT_ID,
                "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
                "PRICE" => $price,
                "CURRENCY" => $cur_code
            );
            $res = CPrice::GetList(
                array(),
                array(
                    "PRODUCT_ID" => $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
                )
            );
            if ($arr = $res->Fetch())
                CPrice::Update($arr["ID"], $arFields);
            else
                CPrice::Add($arFields);
        }
        
        if(!strstr($i/$numberImportingStrings,'.'))
        {
            print 'Загрузка строки №: '.$x.'<br />';
            flush();
            ob_flush();
        }

        if($i==$stringNumber)
        {
            print '<meta http-equiv="Refresh" content="0; url='.$_SERVER['PHP_SELF'].'?x='.$x.'&amp;ftell='.ftell($handle_f).'&amp;path='.$file_name.'">';
            exit;
        }
        
        $x++;
        $i++;
    }

    fclose($handle_f);
}
else 
{
    $err = 1; 
    echo "Не получилось открыть файл";
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>