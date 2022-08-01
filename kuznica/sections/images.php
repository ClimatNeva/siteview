<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');
$catalogIblockId = 12;

$bs = new CIBlockSection;
$sectionId = 0;
/*
$arFilter = array('IBLOCK_ID' => $catalogIblockId);
$rsSect = CIBlockSection::GetList(array(),$arFilter,false,array('ID','XML_ID','CODE','NAME'));
while ($arSect = $rsSect->GetNext())
{
    echo '<pre>';
    print_r($arSect);
    echo '</pre>';
    echo '<br>';
    
    $oldIdAr = explode('_',$arSect["XML_ID"]);
    $oldId = $oldIdAr[1];
    
    $img_url = '/c/'.$oldId.'-category_default/'.$arSect["CODE"].'.jpg';
    $sectionImage = CFile::MakeFileArray($img_url);
    
    $result = $bs->Update($arSect["ID"],
                        array(
                            "PICTURE" => $sectionImage,
                        )
                    );
    
    echo $arSect['NAME'].'<br>';
}*/
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>