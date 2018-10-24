<?php
namespace BH\Frontend;

class Image
{
    const IMG_PATH = '/local/templates/digital/img_web/';

    public static function getPath($img){
        return self::IMG_PATH . $img;
    }
}