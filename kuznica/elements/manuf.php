<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('highloadblock');
CModule::IncludeModule('iblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
global $APPLICATION;

$hlblock = HL\HighloadBlockTable::getById(2)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

/* @var $entity_data_class Bitrix\Main\Entity\DataManager */

$file_name = $_SERVER["DOCUMENT_ROOT"].'/kuznica/elements/ps_manufacturer.csv';
$catalogIblockId = 12;

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ','(',')','.',',','/','"','\'','+','"');
    $lat = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya', '-', '', '','-','-','-','','','-','');
    return str_replace($rus, $lat, $str);
}

$stringNumber = 30;
$numberImportingStrings = 5;

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
        
        /*$name = trim($data_f[3]);
        
        $link_name = mb_strtolower(translit($name));
        $link = '/brands/'.$link_name.'/';
        
        $desc = $data_f[9];
        $fulldesc = $data_f[6];
        $sort = $data_f[0];
        $title = $data_f[12];
        $keywords = $data_f[15];
        $metadesc = $data_f[18];
        
        $vendors_res = $entity_data_class::getList(array(
            'filter' => array('UF_XML_ID' => $link_name),
            'select' => array('ID'),
            'order' => array()
        ));
        if($vendors_ob = $vendors_res->Fetch()) 
        {}
        else
        {
            $result = $entity_data_class::add(array(
                'UF_NAME'     => $name,
                'UF_XML_ID'   => $link_name,
                'UF_LINK'     => $link,
                'UF_DESCRIPTION'   => $desc,
                'UF_FULL_DESCRIPTION'   => $fulldesc,
                'UF_SORT'   => $sort,
                'UF_TITLE'   => $title,
                'UF_KEYWORDS'   => $keywords,
                'UF_META_DESC'   => $metadesc
            ));
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