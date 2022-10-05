<?php

namespace BH\Frontend;

class Frontend
{
    const TEMPLATE_PATH = '/local/templates/climatneva_2021/';

    public static function init()
    {
        require 'Image.php';
        require 'Morph.php';
        require 'Form.php';
    }

    public static function includeArea($path)
    {
        global $APPLICATION;
        return $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '.default',
            array(
                "AREA_FILE_SHOW" => 'page',
                "AREA_FILE_SUFFIX" => 'include/' . $path,
            ),
            false
        );
    }

    public static function getJsSrc($string)
    {
        return self::TEMPLATE_PATH . 'js/' . $string;
    }

    public static function getCssSrc($string)
    {
        return self::TEMPLATE_PATH . 'css/' . $string;
    }
}