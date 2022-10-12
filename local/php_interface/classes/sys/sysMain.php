<?php

/**
 * sysMain
 *
 * Класс необходим для общих системных функций
 */
class sysMain {
    private static $storage = [];
    private static $meta = [];
    private static $metaChanged = false;
    private static $pageNumber = 0;

    /* Сохранение значений переменных для использования в других компонентах */
    public static function setValue($name, $value) {
        self::$storage[$name] = $value;
    }

    /* Извлечение значений переменных для использования в других компонентах */
    public static function getValue($name) {
        if (!empty(self::$storage[$name]))
            return self::$storage[$name];
        else
            return false;
    }

    public static function optimizeContent(&$content) {
        global $USER, $APPLICATION;
        if ((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;
        if ($APPLICATION->GetProperty("save_kernel") == "Y") return;

        $arPatternsToRemove = Array(
        /*'/<script.+?src=".+?kernel_main\/kernel_main\.js\?\d+"><\/script\>/',*/
        '/<script.+?src=".+?bitrix\/js\/main\/jquery\/jquery-1\.8\.3\.min\.js\?\d+"><\/script\>/',
        /*'/<script.+?src=".+?bitrix\/js\/main\/core\/core[^"]+"><\/script\>/',*/
        /*'/<script.+?>BX\.(setCSSList|setJSList)\(\[.+?\]\).*?<\/script>/',*/
        '/<link.+?href=".+?kernel_main\/kernel_main\.css\?\d+"[^>]+>/',
        '/<link.+?href=".+?kernel_main\/kernel_main_v1\.css\?\d+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
        '/<meta.+?name="keywords".+?content="[^"]+".+?\/>/',
        '/page-1\//',
        );

        preg_match_all('/<link rel="canonical[^>]+>/', $content, $result);
        if (sizeof($result[0]) > 1) {
          for ($i = 1; $i < sizeof($result[0]); $i += 1) {
            $content = strtr($content, [$result[0][$i] => ""]);
          }
        }

        $content = preg_replace($arPatternsToRemove, "", $content);

        // Внедряем css в тело страницы
        preg_match_all('/<link.+?href=.+?\.css[^>]+>/', $content, $arResult);
        if (sizeof($arResult)) {
            $root = \Bitrix\Main\Application::getDocumentRoot();
            foreach ($arResult[0] as $row) {
                preg_match_all('/link.+?href="(.+?\.css[^"]+)"/', $row, $arRow);
                $arNeedle = array_pop($arRow);
                $needle = array_shift($arNeedle);
                $cssFile = array_shift( explode("?", $needle) );
                save2log(["needle" => $needle, "root" => $root, "cssFile" => $cssFile]);
                if (empty($cssFile)) continue;
                if (file_exists($root . $cssFile)) {
                    $style = file_get_contents($root . $cssFile);
                    $style = preg_replace('/\/\*.+?\*\//', '', $style);
                    $pattern = '/<link.+?href="'.strtr($cssFile, ["/" => "\/"]).'[^>]+>/';
                    save2log(["cssFile" => $cssFile, "style" => $style, "pattern" => $pattern, ], 'pattern');
                    $content = preg_replace($pattern, "<style>" . $style . "</style>", $content);
                }
                // $arRes[] = [$root . $cssFile, $cssFile, "style" => $style];
            }
        }
        // save2log(SITE_TEMPLATE_PATH);
        $content = str_replace('../../fonts/', '/bitrix/fonts/', $content);
        $content = str_replace('font-style: normal;', 'font-style:normal;font-display:swap;', $content);

        $content = preg_replace("/[\r\n]{2,}/", "\n", $content);
        $content = str_replace(' type="text/javascript"', '', $content);

        //$content = self::setPageValues($content);
        //save2log($content, 'content');

        /*$arPatternsToReplace = array(
            '/(<link.+href=)(".+?main\/bootstrap\.min\.css\?\d+")([^>]+>)/',
            '/(<link.+href=)(".+?main\/font-awesome\.min\.css\?\d+")([^>]+>)/',
            '/(<link.+href=)("\/bitrix\/cache.+\/template_.+\.css\?\d+")([^>]+>)/',
            '/(<link.+href=)("\/bitrix\/cache.+\/default_.+\.css\?\d+")([^>]+>)/'
        );
        $content = preg_replace($arPatternsToReplace, '<link rel="preload" href=$2 as="style" crossorigin="anonymous">$1$2$3', $content);*/
    }

    public static function setPageNumber($number) {
        self::$pageNumber = $number;
    }

    public static function onEpilogHandler() {
        global $USER, $APPLICATION;
        if ((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;

        if (!self::$metaChanged) {
            $arText = [];
            $addFilterMeta = true;
            if (!empty(self::$storage["filterMeta"]) && sizeof(self::$storage["filterMeta"]) < 3) {
                foreach (self::$storage["filterMeta"] as $filterMeta) {
                    $txt = mb_strtolower(mb_substr($filterMeta["NAME"],0,1)).mb_substr($filterMeta["NAME"],1).": ";
                    if (!empty($filterMeta["ITEMS"]) && sizeof($filterMeta["ITEMS"]) == 1) {
                        $items = [];
                        foreach ($filterMeta["ITEMS"] as $item) {
                            if (!empty($item)) $items[] = $item;
                        }
                        if (sizeof($items) > 0) $txt .= implode(", ",$items);
                    } else if (sizeof($filterMeta["ITEMS"]) > 1) {
                        $addFilterMeta = false;
                        self::$meta["meta"]["robots"] = "noindex";
                        break;
                    }
                    if (!empty($filterMeta["MIN"])) {
                        $txt .= "от ".$filterMeta["MIN"];
                    }
                    if (!empty($filterMeta["MAX"])) {
                        $txt .= (!empty($filterMeta["MIN"]) ? " " : "")."до ".$filterMeta["MAX"];
                    }
                    if (!empty($filterMeta["FINISH"])) $txt .= " ".$filterMeta["FINISH"];
                    $arText[] = $txt;
                }
            }
            $textAdd = '';
            if ($addFilterMeta && sizeof($arText) > 0) $textAdd .= ', '.implode("; ",$arText);
            $pageNumAdd = (self::$pageNumber > 1 ? " (стр. ".self::$pageNumber.")" : "");
            self::$meta["meta"]["description"] = $APPLICATION->GetPageProperty('description').$textAdd.$pageNumAdd;
            self::$meta["meta"]["title"] = $APPLICATION->GetPageProperty('title').$textAdd.$pageNumAdd;
            self::$meta["h1"]["heading"] = $APPLICATION->GetTitle('heading').$textAdd.$pageNumAdd;
            self::$meta["h1"]["h1"] = $APPLICATION->GetTitle().$textAdd.$pageNumAdd;
            $request = Bitrix\Main\Context::getCurrent()->getRequest();
            $server = Bitrix\Main\Context::getCurrent()->getServer();
            $link = (self::$pageNumber > 1 ? $request->getRequestedPageDirectory().'/page-'.self::$pageNumber.'/' : $request->getRequestUri());
            $link = preg_replace('#\?PAGEN_1=([\d]+)/#is', self::$pageNumber > 0 ? 'page-'.self::$pageNumber : 'page-$1', $link);
            $link = strtr($link,["/filter/clear/apply" => "", "//" => "/"]);
            self::$meta["canonical"] = ($request->isHttps() ? 'https' : 'http').'://'. $server->getServerName() .$link;
            // if (substr(self::$meta["canonical"],-1,1) !== '/') self::$meta["canonical"] .= '/';
            self::$metaChanged = true;
            self::setPageValues();
        }
    }

    private function setPageValues($content = '') {
        global $APPLICATION;
        foreach (self::$meta as $metaCode => $arItem) {
            switch ($metaCode) {
                case 'meta':
                    foreach ($arItem as $element => $value) {
                        $APPLICATION->SetPageProperty($element, $value);
                    }
                    break;
                case 'h1':
                    foreach ($arItem as $element => $value) {
                        if ($element != "h1") {
                            $APPLICATION->SetPageProperty($element, $value);
                        } else {
                            $APPLICATION->SetTitle($value);
                        }
                    }
                    break;
                case 'canonical':
                    $APPLICATION->AddHeadString("<link rel=\"canonical\" href=\"".$arItem."\">");
                    break;
            }
        }
        return $content;
    }
}
