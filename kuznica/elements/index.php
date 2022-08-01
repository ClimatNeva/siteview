<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/ps_product_lang.csv';
$catalogIblockId = 12;
file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logPr.txt',var_export('start',true));

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
        
        /*$xml = 'prod_'.$data_f[0];
        $prev = trim($data_f[12]);
        $desc = trim($data_f[9]);

        $name = trim($data_f[27]);
        $code = trim($data_f[15]);

        $metadesc = $data_f[18] ? $data_f[18] : "";
        $metakey = $data_f[21] ? $data_f[21] : "";
        $metatitle = $data_f[24] ? $data_f[24] : "";

        $avail_later = $data_f[33];
        $PROP = array();
        $PROP['AVAIL_LATER'] = $avail_later;

        $arLoadProductArray = Array(
            'IBLOCK_ID' => $catalogIblockId,
            'ACTIVE' => 'Y',
            'XML_ID' => $xml,
            'NAME' => $name,
            'CODE' => $code,
            'PREVIEW_TEXT' => $prev,
            'PREVIEW_TEXT_TYPE' => 'html',
            "DETAIL_TEXT" => $desc,
            "DETAIL_TEXT_TYPE" => 'html',
            "IPROPERTY_TEMPLATES" => array(
                "ELEMENT_META_TITLE" => $metatitle, 
                "ELEMENT_META_KEYWORDS" => $metakey, 
                "ELEMENT_META_DESCRIPTION" => $metadesc
            ),
            "PROPERTY_VALUES"=> $PROP
        );

        $el = new CIBlockElement;
        if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
           echo 'New ID: '.$PRODUCT_ID;
        } else {
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logPr.txt',var_export($data_f,true),FILE_APPEND);
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logPr.txt',var_export('Error: '.$el->LAST_ERROR,true),FILE_APPEND);
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logPr.txt',var_export(", ",true),FILE_APPEND);
            echo '<pre>';print_r($data_f);echo '</pre>';
            echo 'Error: '.$el->LAST_ERROR;
        }*/
        
        /**check elements,open after import**/
        /*$arFilter = array('IBLOCK_ID' => 23, 'XML_ID' => 'prod_'.$data_f[0]);
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, Array(), array('ID','XML_ID'));
        if($obElem = $rsElements->GetNext())
        {}
        else {
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logPr.txt',var_export($data_f[0],true),FILE_APPEND);
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/logPr.txt',var_export(", ",true),FILE_APPEND);
        }*/
        /*****/
        
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