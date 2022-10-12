<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResize = ["width" => 200, "height" => 100];

foreach ($arResult["rows"] as &$item) {
  if (empty($item["UF_FILE"])) continue;
    $image = explode('"', $item["UF_FILE"])[1];
    $item["IMAGE_SRC"] = $image;
    $arImage = explode('/', trim($image, '/'));
    $newImageName = '/'.$arImage[0].'/resize_cache/'.$arImage[1].'/'.$arImage[2].'/'.$arResize["width"].'_'.$arResize["height"].'_1/'.$arImage[3];
    $fullImageName = $_SERVER['DOCUMENT_ROOT'].$newImageName;
    if (file_exists($fullImageName) || CFile::ResizeImageFile($_SERVER['DOCUMENT_ROOT'].$image, $fullImageName, $arResize)) {
      $item["IMAGE"] = $newImageName;
    }
}
