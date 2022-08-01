<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/my_ps_product_manufacturer.csv';
$catalogIblockId = 12;

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ','(',')','.',',','/','"','\'','+','"');
    $lat = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya', '-', '', '','-','-','-','','','-','');
    return str_replace($rus, $lat, $str);
}

$stringNumber = 100;
$numberImportingStrings = 50;

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
        $xml = 'prod_'.$data_f[6];
        $manuf = $data_f[3];
        $link_name = mb_strtolower(translit($manuf));
        
        $arFilter = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID' => $xml);
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, Array(), array('ID','XML_ID'));
        if($obElem = $rsElements->GetNext())
        {
            $PRODUCT_ID = $obElem['ID'];
            echo $PRODUCT_ID.' - ';
            echo $link_name.'<br>';
            CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "MANUFACTURER", $link_name);
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