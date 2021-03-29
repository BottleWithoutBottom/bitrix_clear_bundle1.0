<?php

namespace Letsrock\Lib\Models;
use \Bitrix\Main\Loader;
use \CIBlockElement;

Loader::includeModule('iblock');

class InfoblockModel extends Model
{
    public CONST VALUE = 'VALUE';

    protected $infoblockId;
    protected $symbolCode;

    public function fetch($order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        $filter = $this->setFullFilter($filter);

        $query = CIBlockElement::GetList($order, $filter, false, false, $select);

        if ($row = $query->Fetch()) {
            return $query;
        }

        return [];
    }

    public function fetchAll($order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        $filter = $this->setFullFilter($filter);
        $res = [];
        $query = CIBlockElement::GetList($order, $filter, false, false, $select);

        if ($row = $query->Fetch()) {
            $res[] = $row;
        }

        return $res;
    }

    /** Метод для получения значений свойства типа "привязка к элементу"
     * @param array $properties
     * @param string $propertyName
     * @return array
     */
    public function fetchElementsProperty($properties, $propertyName, $order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        if (
            empty($properties)
            || empty($propertyName)
            || empty($properties[$propertyName][static::VALUE])
        ) return [];

        $value = $properties[$propertyName][static::VALUE];
        $valueIsArray = is_array($value);

        if ($valueIsArray) {
            $preFilter = array_merge($value, $filter);
        } else {
            $preFilter = array_merge($filter, ['ID' => $value]);
        }
        $row = CIBlockElement::GetList($order , $preFilter, false, false, $select);

        $res = [];
        while ($element = $row->Fetch()) {
            $res[] = $element;
        }

        return $res;
    }

    public static function addPropertyPrefix($string)
    {
        if (empty($string)) return false;

        return 'PROPERTY_' . $string;
    }

    public static function addValuePostfix($string)
    {
        if (empty($string)) return false;

        return $string . '_VALUE';
    }

    /** Добавляет строке вид PROPERTY_ $string _VALUE */
    public static function addPropertyEnclose($string)
    {
        if (empty($string)) return false;

        return static::addValuePostfix(static::addPropertyPrefix($string));
    }

    public function getSymbolCode()
    {
        return $this->symbolCode;
    }

    public function getInfoblockId()
    {
        return $this->infoblockId;
    }

    private function getPrefilter()
    {
        return ['IBLOCK_ID' => $this->getInfoblockId()];
    }

    protected function setFullFilter($filter)
    {
        if (empty($filter)) return $this->getPrefilter();

        return array_merge($filter, $this->getPrefilter());
    }

    public static function getDefaulOrder()
    {
        return ['ID' => 'ASC'];
    }
}