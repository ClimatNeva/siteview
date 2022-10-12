<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arPics = [];
$dbList = \Bitrix\Main\FileTable::getList([
  "filter" => ["ID" => array_column($arResult["SECTIONS"], "DETAIL_PICTURE")],
  "select" => ["ID", "FILE_NAME", "SUBDIR", "WIDTH", "HEIGHT", "CONTENT_TYPE"],
  "cache" => ["ttl" => 86400, "cache_joins" => true],
])->fetchAll();
foreach ($dbList as $row) {
  $row["SRC"] = "/upload/" . $row["SUBDIR"] . "/" . $row["FILE_NAME"];
  $arPics[$row["ID"]] = $row;
}

foreach ($arResult["SECTIONS"] as &$section) {
    if (!empty($section["DETAIL_PICTURE"])) {
      $section["ICON"] = $arPics[$section["DETAIL_PICTURE"]];
        // $section["ICON"] = CFile::ResizeImageGet($section["DETAIL_PICTURE"], ["width"=>400,"height"=>250])["src"];
    }
}

unset($dbList, $arPics);