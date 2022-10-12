<?
use Bitrix\Main\IO,
    Bitrix\Main\Application;
/**
 * htmlTools
 *
 * Класс вывода различных блоков html
 */
class htmlTools {
    private static $defaultWidthSets = [
        576 => ["size" => 576, "width" => 576, "height" => 576],
        992 => ["size" => 992, "width" => 992, "height" => 640],
        1200 => ["size" => 1200, "width" => 1200, "height" => 800],
    ];
    private static $defaultFilter = ["name" => "sharpen", "precision" => 0];

    /**
     * Новая отрисовка блока <picture></picture>
     * @param $arImage - типовой массив файла Битрикса
     * @param $arParams - параметры вывода
     */
    public static function drawPictureTagWithWebp(array $arImageSources, array $arParams = []) {
        if (empty($arImageSources) || empty($arImageSources[0])) return false;

        if (empty($arParams["widthSets"]))
            $arParams["widthSets"] = self::$defaultWidthSets;

        $createSizes = sizeof($arImageSources) === 1;
        $arSizes = array_keys($arParams["widthSets"]);
        $min = min($arSizes);
        if (sizeof($arSizes) > 1) {
          rsort($arSizes);
          $max = max($arSizes);
          if (in_array(0, $arSizes)) {
              $arTmp = $arSizes;
              $key = array_search(0, $arTmp);
              unset($arTmp[$key]);
              $min = min($arTmp);
              unset($arTmp);
          }
        }
        $crop = (!empty($arParams["crop"]) && $arParams["crop"]);
        $lazyText = $arParams["lazyload"] ?? "";
        $webp = $arParams["webp"] ?? 0;

        if ($createSizes) {
            $arImageSources[0] = self::checkAttributes($arImageSources[0]);
            if (substr($arImageSources[0]["CONTENT_TYPE"], 0, 5) !== "image") return false;
        }

        $arResult = $arSmall = $arCurrent = [];

        foreach ($arSizes as $size) {
            if (!$createSizes && $size === 0) continue;
            $widthSet = $arParams["widthSets"][$size];
            $arImage = ($createSizes || empty($arImageSources[$size])) ? $arImageSources[0] : $arImageSources[$size];

            $arImage = self::checkAttributes($arImage);
            if (substr($arImage["CONTENT_TYPE"], 0, 5) !== "image") return false;
            if ($size !== 0 && $size === $max) {
                $arSmall = self::resizeImage($arImageSources[0] ?? $arImage, $arParams["widthSets"][0]["width"], $arParams["widthSets"][0]["height"], $crop, $webp, true);
                $arResult[] = self::createSourceTag($arSmall, ($min - 0.02), $lazyText, "max");
                $widthSet["width"] = 1920;
                $widthSet["height"] = 1200;
            }
            $arCurrent = self::resizeImage($arImage, $widthSet["width"], $widthSet["height"], $crop, $webp, true);
            $arResult[] = self::createSourceTag($arCurrent, $size, $lazyText);
        }
        $arResult[] = self::createImgTag(!empty($arSmall) ? $arSmall : $arCurrent, $arParams["itemName"] ?? "", $lazyText, $arParams["extraText"] ?? "");

        $class = !empty($arParams["cssClass"]) ? " class=\"".implode(" ", $arParams["cssClass"])."\"" : "";
        array_unshift($arResult, "<picture".$class.">");
        $arResult[] = "</picture>";

        echo implode("\n", $arResult);
    }

    private static function checkAttributes($arImage) {
        if (empty($arImage["SRC"])) $arImage["SRC"] = self::getFileSource($arImage);
        if (empty($arImage["CONTENT_TYPE"])) $arImage["CONTENT_TYPE"] = self::getContentType($arImage);
        if (empty($arImage["WIDTH"]) || empty($arImage["HEIGHT"])) {
            list($arImage["WIDTH"], $arImage["HEIGHT"]) = getimagesize(Application::getDocumentRoot() . $arImage["SRC"]);
        }
        return $arImage;
    }

    private static function createSourceTag($arImage, $size, $lazyAddText = "", $type = "min") {
        $media = $size === 0 ? "" : "media=\"(".$type."-width: ".$size."px)\"";
        $outStr = "";
        if (!empty($arImage["webp"])) {
            $outStr .= "<source ".$media." ".$lazyAddText."srcset=\"".$arImage["webp"]."\" type=\"image/webp\">";
        }
        $outStr .= "<source ".$media." ".$lazyAddText."srcset=\"".$arImage["SRC"]."\" data-width=\"".$arImage["WIDTH"]."\" data-height=\"".$arImage["HEIGHT"]."\" type=\"".$arImage["CONTENT_TYPE"]."\">";
        return $outStr;
    }

    private static function createImgTag($arImage, $itemName = "", $lazyAddText = "", $extraText = "") {
        $outStr = "<img alt=\"".$itemName."\" ".$lazyAddText."src=\"".($arImage["webp"] ?? $arImage["SRC"])."\" width=\"".$arImage["WIDTH"]."\" height=\"".$arImage["HEIGHT"]."\" ".$extraText.">";
        return $outStr;
    }

    private static function resizeImage($image, $width = 50, $height = 50, $minSize = false, $webp = 0, $upperCase = false) {
        $resize = $minSize ? BX_RESIZE_IMAGE_EXACT : BX_RESIZE_IMAGE_PROPORTIONAL;
        $item = CFile::ResizeImageGet($image, ["width" => $width, "height" => $height], $resize, true, ["name" => "sharpen", "precision" => 0]);
        $sizeNames = ["width" => "WIDTH", "height" => "HEIGHT", "src" => "SRC", "size" => "SIZE"];
        if ($upperCase) {
            foreach ($sizeNames as $key => $code) {
                $item[$code] = $item[$key];
                unset($item[$key]);
            }
        }
        if ($webp > 0) {
            foreach ($sizeNames as $key) {
                $image[$key] = $item[$key];
            }
            $item["webp"] = htmlWebp::getResizeWebpSrc($image, $width, $height, !$minSize, $webp);
        }
        $item["CONTENT_TYPE"] = $image["CONTENT_TYPE"];
        return $item;
    }

    private static function getFileSource($fileArray) {
        if (!empty($fileArray["SUBDIR"]) && !empty($fileArray["FILE_NAME"])) {
            return "/upload/" . $fileArray["SUBDIR"] . "/" . $fileArray["FILE_NAME"];
        }
        $arImage = CFile::GetByID($fileArray["ID"])->GetNext();
        return "/upload/" . $arImage["SUBDIR"] . "/" . $arImage["FILE_NAME"];
    }

    public static function getFileArrayByList($fileList) {
        $dbList = \Bitrix\Main\FileTable::getList([
            "filter" => ["ID" => $fileList],
            "select" => ["*"],
            "cache" => ["ttl" => 86400, "cache_joins" => true],
        ])->fetchAll();
        
        $arFiles = [];
        foreach ($dbList as $fileArray) {
            $fileArray["SRC"] = "/upload/" . $fileArray["SUBDIR"] . "/" . $fileArray["FILE_NAME"];
            $arFiles[$fileArray["ID"]] = $fileArray;
        }
        return $arFiles;
    }

    public static function getContentType($arImage) {
        if (empty($arImage["SRC"]) && !empty($arImage["src"])) {
            $arImage["SRC"] = $arImage["src"];
        } else if (empty($arImage["SRC"]) && !empty($arImage["ID"])) {
            $arImage["SRC"] = self::getFileSource($arImage["ID"]);
        } else {
            return false;
        }
        $fName = Application::getDocumentRoot() . $arImage["SRC"];
        if (!file_exists($fName)) return false;

        $fObject = new IO\File($fName);
        return $fObject->getContentType();
    }

    /**
     * Отрисовка блока <picture></picture>
     * @param $arImage - типовой массив файла Битрикса
     * @param $arParams - параметры вывода
     */
    public static function drawPictureTag(array $arImage, array $arParams = []) {
        if (empty($arImage)) return false;

        if (empty($arImage["SRC"])) $arImage["SRC"] = self::getFileSource($arImage["ID"]);
        if (empty($arImage["CONTENT_TYPE"])) $arImage["CONTENT_TYPE"] = self::getContentType($arImage);
        if (substr($arImage["CONTENT_TYPE"], 0, 5) !== "image") return false;

        if (empty($arImage["WIDTH"]) || empty($arImage["HEIGHT"])) {
            list($arImage["WIDTH"], $arImage["HEIGHT"]) = getimagesize(Application::getDocumentRoot() . $arImage["SRC"]);
        }

        if (empty($arParams["widthSets"]))
            $arParams["widthSets"] = self::$defaultWidthSets;
        
        $lazyAddText = (!empty($arParams["lazyload"]) && $arParams["lazyload"]) ? 'class="owl-lazy" data-' : '';
        $crop = !empty($arParams["crop"]) && $arParams["crop"] ? BX_RESIZE_IMAGE_EXACT  : BX_RESIZE_IMAGE_PROPORTIONAL;
        $class = !empty($arParams["cssClass"]) ? " class=\"".implode(" ", $arParams["cssClass"])."\"" : "";
        $showWebp = !empty($arParams["webp"]) && $arParams["webp"];
        $lastSize = 0;
        $outStr = "<picture".$class.">";

        foreach ($arParams["widthSets"] as $key => $arSize) {
            if ($arImage["WIDTH"] <= $arSize["width"] && $arImage["HEIGHT"] <= $arSize["height"]) {
                $lastSize = ($key === 0) ? 0 : $arParams["widthSets"][$key - 1]["size"];
                break;
            }
            $resize = ["width" => $arSize["width"], "height" => $arSize["height"]];
            $pic = CFile::ResizeImageGet($arImage["ID"], $resize, $crop, true, self::$defaultFilter);
            $outStr .= "<source media=\"(max-width: ".$arSize["size"]."px)\" ".$lazyAddText."srcset=\"".$pic["src"]."\" type=\"".$arImage["CONTENT_TYPE"]."\">";
            if ($showWebp) {
                $outStr .= "<source media=\"(max-width: ".$arSize["size"]."px)\" ".$lazyAddText."srcset=\"".htmlWebp::getResizeWebpSrc($arImage, $arSize["width"], $arSize["height"])."\" type=\"image/webp\">";
            }
            $lastSize = $arSize["size"];
        }

        if ($lastSize !== 0) {
            $outStr .= "<source media=\"(min-width: ".($lastSize + 1)."px)\" ".$lazyAddText."srcset=\"".$arImage["SRC"]."\" type=\"".$arImage["CONTENT_TYPE"]."\">";
            if ($showWebp) {
                $outStr .= "<source media=\"(min-width: ".($lastSize + 1)."px)\" ".$lazyAddText."srcset=\"".htmlWebp::getResizeWebpSrc($arImage, $arImage["WIDTH"], $arImage["HEIGHT"])."\" type=\"image/webp\">";
            }
        }

        $alt = "";
        if (!empty($arImage["ALT"])) $alt = $arImage["ALT"];
        elseif (!empty($arParams["itemName"])) $alt = $arParams["itemName"];
        $outStr .= "<img alt=\"".$alt."\" ".$lazyAddText."src=\"".$arImage["SRC"]."\" width=\"".$arImage["WIDTH"]."\" height=\"".$arImage["HEIGHT"]."\">";
        if ($showWebp) {
            $outStr .= "<img alt=\"".$alt."\" ".$lazyAddText."src=\"".htmlWebp::getResizeWebpSrc($arImage, $arImage["WIDTH"], $arImage["HEIGHT"])."\" width=\"".$arImage["WIDTH"]."\" height=\"".$arImage["HEIGHT"]."\">";
        }
        $outStr .= "</picture>";
        
        echo $outStr;
    }

    /* Функция изменения размера изображения с гарантированным получением размеров
    * $imageID - ID файла в БД
    * $width - ширина картинки на выходе
    * $height - высота картинки на выходе
    * $minSize - ширина и высота принимаются за минимальные значения
    * Возвращает массив с полями:
    * src - ссылка на изображение на сайте
    * width - ширина картинки
    * height - высота картинки
    */
    public static function resizeImageWithSize($imageID, $width = 50, $height = 50, $minSize = false, $webp = 0, $upperCase = false) {
        $sizeNames = $upperCase ? ["width" => "WIDTH", "height" => "HEIGHT", "src" => "SRC"] : ["width" => "width", "height" => "height", "src" => "src"];
        if (empty($imageID)) {
            return [
                $sizeNames["src"] => "/images/no-image.png",
                $sizeNames["width"] => $width,
                $sizeNames["height"] => $height,
                "ID" => 0
            ];
        }

        if (is_array($width)) {
            list("width" => $width, "height" => $height) = $width;
        }
        
        $resize = $minSize ? BX_RESIZE_IMAGE_EXACT : BX_RESIZE_IMAGE_PROPORTIONAL;

        $item = CFile::ResizeImageGet($imageID, ["width" => $width, "height" => $height], $resize, true, ["name" => "sharpen", "precision" => 0]);
        if (!$item) {
            $item = [];
            $item[$sizeNames["src"]] = CFile::GetPath($imageID);
        }
        $item["ID"] = $imageID;
        $item["CONTENT_TYPE"] = self::getContentType($item);
        $fName = $_SERVER["DOCUMENT_ROOT"].$item["src"];
        if (empty($item[$sizeNames["width"]]) && file_exists($fName)) {
            $type = mime_content_type($fName);
            if (strpos($type, 'svg') !== false) {
                $fXML = file_get_contents($fName);
                $xmlget = simplexml_load_string($fXML);
                $xmlattributes = $xmlget->attributes();
                $item[$sizeNames["width"]] = (string) $xmlattributes->width;
                $item[$sizeNames["height"]] = (string) $xmlattributes->height;
            } else {
                list($item[$sizeNames["width"]], $item[$sizeNames["height"]]) = getimagesize($fName);
            }
        }
        if ($webp > 0) {
            $item["webp"] = htmlWebp::getResizeWebpSrc($imageID, $width, $height, true, $webp);
        }
        return $item;
    }
}