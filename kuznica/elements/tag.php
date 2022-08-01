<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/ps_product_tag.csv';
$catalogIblockId = 12;

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
        $PRODUCT_ID = 0;
        $tag = trim($data_f[3]);
        $prod_xml = 'prod_'.$data_f[6];
        
        if (strlen($tag)>0)
        {
            $arFilterElem = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID'=>$prod_xml);
            $resElem = CIBlockElement::GetList(Array(), $arFilterElem, false, Array(), array('ID','XML_ID','TAGS'));
            if($obElem = $resElem->GetNext())
            {
                $PRODUCT_ID = $obElem['ID'];
                
                if (strlen($obElem['TAGS'])>0)
                    $tags = $obElem['TAGS'].', '.$tag;
                else
                    $tags = $tag;

                $arLoadProductArray = Array(
                    'IBLOCK_ID' => $catalogIblockId,
                    'TAGS' => $tags
                );

                $res = $el->Update($PRODUCT_ID, $arLoadProductArray);

                if($res)
                    echo 'ID: '.$data_f[0];
                else
                    echo $data_f[0].' - Error: '.$bs->LAST_ERROR;
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