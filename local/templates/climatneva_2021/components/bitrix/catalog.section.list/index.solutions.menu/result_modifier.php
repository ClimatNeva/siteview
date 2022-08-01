<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult["SECTIONS"] as &$section) {
    if (!empty($section["DETAIL_PICTURE"])) {
        $section["ICON"] = CFile::ResizeImageGet($section["DETAIL_PICTURE"], ["width"=>400,"height"=>250])["src"];
    }
}