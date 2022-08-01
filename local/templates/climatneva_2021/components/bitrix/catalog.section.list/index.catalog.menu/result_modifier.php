<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult["SECTIONS"] as &$section) {
    if (!empty($section["UF_2LEVEL_ICON"])) {
        $section["ICON"] = CFile::ResizeImageGet($section["UF_2LEVEL_ICON"], ["width"=>85,"height"=>85])["src"];
    }
}