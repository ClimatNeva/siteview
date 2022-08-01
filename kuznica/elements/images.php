<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/ps_image.csv';
$catalogIblockId = 12;

$stringNumber = 2;
$numberImportingStrings = 1;

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
        
        $id_img = $data_f[0];
        $xml = 'prod_'.$data_f[3];
        $isCover = $data_f[9];
        
        
        $arFilter = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID' => $xml);
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, Array(), array('ID','XML_ID','CODE'));
        if($obElem = $rsElements->GetNext())
        {
            $PRODUCT_ID = $obElem['ID'];
            
            $img_url = '/'.$id_img.'-large_default/'.$obElem["CODE"].'.jpg';
            $productImage = CFile::MakeFileArray($img_url);
            
            if ($isCover)
            {
                $arLoadProductArray = Array(
                    'IBLOCK_ID' => $catalogIblockId,
                    'DETAIL_PICTURE' => $productImage              
                );

                $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
            }                
            else
            {
                CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "MORE_PHOTO", $productImage);
            }
            
            echo $PRODUCT_ID.' - ';
            echo $id_img.'<br>';
            echo $isCover.'<br><br>';
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