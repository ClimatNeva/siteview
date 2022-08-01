<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/sections/ps_category_lang.csv';
$catalogIblockId = 12;

$stringNumber = 60;
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
        
        /*$xml = 'group_'.$data_f[0];
        $name = trim($data_f[9]);        
        $desc = trim($data_f[12]);
        $code = $data_f[15];
        $metatitle = $data_f[18] ? $data_f[18] : "";
        $metakey = $data_f[21] ? $data_f[21] : "";
        $metadesc = $data_f[24] ? $data_f[24] : "";

        $bs = new CIBlockSection;
        $arFields = Array(
            "ACTIVE" => 'Y',
            "IBLOCK_ID" => $catalogIblockId,
            "XML_ID" => $xml,
            "NAME" => $name,
            "DESCRIPTION" => $desc,
            "DESCRIPTION_TYPE" => 'html',
            "CODE" => $code,
            "IPROPERTY_TEMPLATES" => array(
                "SECTION_META_TITLE" => $metatitle, 
                "SECTION_META_KEYWORDS" => $metakey, 
                "SECTION_META_DESCRIPTION" => $metadesc
            )
        );

        $ID = $bs->Add($arFields);
        if($ID)
           echo $data_f[0].' - New ID: '.$ID;
        else
           echo $data_f[0].' - Error: '.$bs->LAST_ERROR;*/
        
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