<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/ps_category_product.csv';
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
        $section_id = 0;
        $ar_new_groups = array();
        
        $section_xml = trim($data_f[0]);
        $section_xml = 'group_'.$section_xml;
        $elem_xml = trim($data_f[3]);
        $elem_xml = 'prod_'.$elem_xml;
        $sort = $data_f[6];

        $arFilterElem = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID'=>$elem_xml);
        $resElem = CIBlockElement::GetList(Array(), $arFilterElem, false, Array(), array('ID','XML_ID'));
        if($obElem = $resElem->GetNext())
        {
            $PRODUCT_ID = $obElem['ID'];

            $arFilterParent = array('IBLOCK_ID' => $catalogIblockId, 'XML_ID'=>$section_xml);
            $rsSectionsParent = CIBlockSection::GetList(array(), $arFilterParent, false, array('ID','XML_ID'));
            if($arSectionParent = $rsSectionsParent->Fetch())
            {
                $section_id = $arSectionParent['ID'];

                $db_old_groups = CIBlockElement::GetElementGroups($PRODUCT_ID, true);
                while($ar_group = $db_old_groups->Fetch())
                    $ar_new_groups[] = $ar_group["ID"];

                $ar_new_groups[] = $section_id;

                $arLoadProductArray = Array(
                    'IBLOCK_ID' => $catalogIblockId,
                    'IBLOCK_SECTION' => $ar_new_groups,
                    'SORT' => $sort                
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