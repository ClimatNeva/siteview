<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as &$item) {
  if (!empty($item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"]["SRC"])
    &&
    (empty($item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"]["WIDTH"]) || empty($item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"]["HEIGHT"]))) {
      $pic = htmlTools::resizeImageWithSize($item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"]["ID"], 50, 50, false, 0, true);
      $item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"]["WIDTH"] = $pic["WIDTH"];
      $item["DISPLAY_PROPERTIES"]["ICON"]["FILE_VALUE"]["HEIGHT"] = $pic["HEIGHT"];
    }
}