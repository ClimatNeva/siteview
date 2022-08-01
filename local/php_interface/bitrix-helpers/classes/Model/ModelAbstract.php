<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 10.11.2017
 * Time: 0:10
 */

namespace BH\Model;
use CIBlock;

/**
 * Class ModelAbstract
 * @package BH\Model
 *
 * @property integer $id
 * @property integer $iblockId
 * @property string $name
 * @property string $detailPageUrl
 * @property \stdClass $previewPicture
 */
abstract class ModelAbstract
{
    const IBLOCK_ID = 0;
    const PRIMARY_KEY = 'ID';

    public $properties;
    public $propertiesExtra;

    /**
     * @return int
     */
    public static function getIblockID()
    {
        /** @var ModelAbstract $class */
        $class = get_called_class();
        return $class::IBLOCK_ID;
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        /** @var ModelAbstract $class */
        $class = get_called_class();

        return $class::PRIMARY_KEY;
    }

    /**
     * @return string
     */
    public function getModelPrimaryKey()
    {
        /** @var ModelAbstract $class */
        $class = get_called_class();

        return self::camelCase($class::PRIMARY_KEY);
    }

    /**
     * @param $arModel
     * @param $key
     * @return string
     */
    static function createModel($arModel)
    {
        /** @var ModelAbstract $class */
        $class = get_called_class();

        /** @var ModelAbstract $model */
        $model = new $class();
        $model->setProperties($arModel);

        foreach ($arModel as $field => $value) {

            if ($field[0] === '~')
                continue;

            if (strpos($field, 'PROPERTY') === 0)
                $model->setProperty($field, $value);

            $modelField = self::camelCase($field);

            if (is_array($value)) {
                foreach ($value as $subField => $subValue)
                    $model->$modelField->{self::camelCase($subField)} = $subValue;
            } else {
                $model->$modelField = $value;
            }
        }

        return $model;
    }

    /**
     * @param $arModels
     * @return array
     */
    static function createModels($arModels)
    {
        /** @var ModelAbstract $class */
        $class = get_called_class();

        /** @var ModelAbstract $model */
        $model = new $class();

        return array_map(array($class, 'createModel'), $arModels);
    }

    /**
     * @return array
     */
    static function getDefaultFilter()
    {
        return array(
            'IBLOCK_ID' => self::getIblockID(),
            'INCLUDE_SUBSECTIONS' => 'Y'
        );
    }

    /**
     * @return array
     */
    static function getDefaultSort()
    {
        return array(
            'SORT' => 'ASC',
            'NAME' => 'ASC'
        );
    }

    /**
     * @return array
     */
    static function getBaseFieldsSelect()
    {
        return array(
            'ID', 'IBLOCK_ID', 'NAME', 'CODE',
        );
    }

    /**
     * @return array
     */
    static function getPropertiesSelect()
    {
        return array();
    }

    /**
     * @param array $filter
     * @param array $sort
     * @param bool $group
     * @param array $limit
     * @param array $select
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getList(
        $filter = array(),
        $sort = array(),
        $group = false,
        $limit = array(),
        $select = array()
    )
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        /** @var \CPHPCache $obCache */
        $obCache = new \CPHPCache();
        $models = array();

        /** Todo: cache system */
        if ($obCache->InitCache(0, '', __CLASS__ . __METHOD__)) {

            $models = $obCache->GetVars();

        } elseif ($obCache->StartDataCache()) {

            /** @var \CIBlockElement $CIBlockElement */
            $CIBlockElement = new \CIBlockElement();

            /** @var \CIBlockResult $sql */
            $sql = $CIBlockElement->GetList(
                array_merge(
                    self::getDefaultSort(),
                    $sort
                ),
                array_merge(
                    self::getDefaultFilter(),
                    $filter
                ),
                $group,
                array_merge(
                    self::getDefaultFilter(),
                    $limit
                ),
                array_merge(
                    self::getFullSelect(),
                    $select
                )
            );

            while ($arModel = $sql->Fetch()) {
                $models[$arModel['ID']] = self::createModel($arModel);
            }
        }

        return $models;
    }

    /**
     * @return array
     */
    private static function getFullSelect()
    {
        return array_merge(
            self::getBaseFieldsSelect(),
            self::getPropertiesSelect()
        );
    }

    /**
     * @param $str
     * @param array $noStrip
     * @return mixed|null|string|string[]
     *
     * @author http://www.mendoweb.be/blog/php-convert-string-to-camelcase-string/
     */
    public static function camelCase($str, array $noStrip = [])
    {
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', strtolower($str));
        $str = trim($str);

        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
    }

    /**
     * @param $arModel
     */
    private function setProperties(&$arModel)
    {
        foreach ($arModel['PROPERTIES'] as $field => $value) {
            $this->setProperty($field, $value);
        }

        unset($arModel['PROPERTIES']);
    }

    /**
     * @param $field
     * @param $value
     */
    private function setProperty($field, $value)
    {
        $camelField = self::camelCase($field);

        if (is_array($value)) {
            foreach ($value as $subField => $subValue)
                $this->propertiesExtra->{$camelField}->{self::camelCase($subField)} = $subValue;

        } else {
            // todo
        }

        $this->properties->{$camelField} = $value;
    }

    /**
     * @param \CBitrixComponentTemplate $component
     */
    public function getEditLink(\CBitrixComponentTemplate $component)
    {
         $component->AddEditAction($this->id, $this->editLink,
            CIBlock::GetArrayByID($this->iblockId, 'ELEMENT_EDIT')
        );
    }
}