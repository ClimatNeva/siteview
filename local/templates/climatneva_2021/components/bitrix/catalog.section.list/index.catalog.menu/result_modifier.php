<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arPics = [];
$dbList = \Bitrix\Main\FileTable::getList([
  "filter" => ["ID" => array_column($arResult["SECTIONS"], "UF_2LEVEL_ICON")],
  "select" => ["ID", "FILE_NAME", "SUBDIR", "WIDTH", "HEIGHT", "CONTENT_TYPE"],
  "cache" => ["ttl" => 86400, "cache_joins" => true],
])->fetchAll();
foreach ($dbList as $row) {
  $row["SRC"] = "/upload/" . $row["SUBDIR"] . "/" . $row["FILE_NAME"];
  $arPics[$row["ID"]] = $row;
}

foreach ($arResult["SECTIONS"] as &$section) {
  if (!empty($section["UF_2LEVEL_ICON"]) && !empty($arPics[$section["UF_2LEVEL_ICON"]])) {
    $section["ICON"] = $arPics[$section["UF_2LEVEL_ICON"]];
    // $section["ICON"] = CFile::ResizeImageGet($section["UF_2LEVEL_ICON"], ["width"=>85,"height"=>85])["src"];
  }
}

unset($dbList, $arPics);