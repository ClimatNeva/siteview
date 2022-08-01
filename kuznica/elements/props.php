<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$props = array(
    8 => "MOSHNOST_OHLAGHD",
    9 => "MOSHNOST_OBOGREVA",
    10 => "POTREB_MOSHNOST",
    11 => "RAB_TEMP",
    12 => "MAX_DLINA_TRUB",
    13 => "STRANA",
    14 => "PULT_UPR",
    15 => "UPR_MOSH",
    16 => "MAX_OBSL_PLOSHAD",
    17 => "UROVEN_SHUMA",
    18 => "GABARITY_VNUTR_BLOKA",
    19 => "VES_VNUTR_BLOKA",
    20 => "GABARITY_VNESH_BLOKA",
    21 => "VES_VNESH_BLOKA",
    22 => "GARANTY",
    23 => "DOP_FILTRI",
    24 => "GABARITY",
    25 => "VES_KG",
    26 => "RASHOD_VOZD",
);

CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/my_ps_feature_value_lang.csv';
$catalogIblockId = 12;

$stringNumber = 50;
$numberImportingStrings = 10;

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
        //echo '<pre>';print_r($data_f);echo '</pre>';
        
        /*$el = new CIBlockElement;
        $PRODUCT_ID = 0;
        $prod_xml = 'prod_'.$data_f[3];
        $prop_id = trim($data_f[6]);
        $prop_value = trim($data_f[9]);
        
        $arFilterElem = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID'=>$prod_xml);
        $resElem = CIBlockElement::GetList(Array(), $arFilterElem, false, Array(), array('ID','XML_ID'));
        if($obElem = $resElem->GetNext())
        {
            $PRODUCT_ID = $obElem['ID'];

            if (CIBlockElement::SetPropertyValueCode($PRODUCT_ID, $props[$prop_id], $prop_value))
            {
                echo $PRODUCT_ID.' - '.$props[$prop_id].' - '.$prop_value.'<br>';
            }
            else
            {
                echo '!!!Error: '.$PRODUCT_ID.' - '.$props[$prop_id].' - '.$prop_value.'<br>';
                file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logProps.txt',var_export($PRODUCT_ID,true),FILE_APPEND);
                file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logProps.txt',var_export(" - ",true),FILE_APPEND);
                file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logProps.txt',var_export($props[$prop_id],true),FILE_APPEND);
                file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logProps.txt',var_export(" - ",true),FILE_APPEND);
                file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logProps.txt',var_export($prop_value,true),FILE_APPEND);
                file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logProps.txt',var_export('===',true),FILE_APPEND);
            }
        }*/
        
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

