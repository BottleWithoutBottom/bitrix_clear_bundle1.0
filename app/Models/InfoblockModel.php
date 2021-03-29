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

    /** Если есть необходимость в создание ЧПУ урлов у инфоблока, у модели нужно вызвать метод setSefMode('/section/#SECTION_URL#'...) */
    protected $sefMode;

    public function fetch($order = ['ID' => 'ASC'], $filter = [], $select = ['*'], $sefMode = false)
    {
        $filter = $this->setFullFilter($filter);

        $query = CIBlockElement::GetList($order, $filter, false, false, $select);
        if ($sefMode) $query->SetUrlTemplates($this->getSefMode());

        if ($row = $query->GetNext()) {
            return $query;
        }

        return [];
    }

    public function fetchAll($order = ['ID' => 'ASC'], $filter = [], $select = ['*'], $sefMode = false)
    {
        $filter = $this->setFullFilter($filter);
        $res = [];

        $query = CIBlockElement::GetList($order, $filter, false, false, $select);
        if ($sefMode) $query->SetUrlTemplates($this->getSefMode());
        if ($row = $query->GetNext()) {
            $res[] = $row;
        }

        return $res;
    }

    /** Метод для получения значений свойства типа "привязка к элементу" для элемента CIBlockResult
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
        while ($element = $row->GetNext()) {
            $res[] = $element;
        }

        return $res;
    }

    /** Метод достает свойства типа "привязка к элементу сразу для нескольких элементов CIBlockResult" */
    public function fetchAllElementsProperty($items, $propertyName, $order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        if (empty($items || empty($propertyName))) return false;

        $propertyIds = [];

        //Собираем айдишники со всех элементов
        foreach ($items as $item) {
            $itemProps = $item['PROPERTIES'];
            $propertyId = $itemProps[$propertyName][static::VALUE];
            if (!empty($propertyId)) {
                if (is_array($propertyId)) {
                    $propertyIds = array_merge($propertyId, $propertyIds);
                } else {
                    $propertyIds[] = $propertyId;
                }
            }
        }

        if (!empty($propertyIds)) {

            return $this->fetchElementsProperty(
                [
                    $propertyName => [static::VALUE => $propertyIds]
                ],
                $propertyName,
                $order,
                $filter,
                $select
            );
        }

        return false;
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

    /**
     * @return mixed
     */
    public function getSefMode() {
        return $this->sefMode;
    }

    /**
     * @param mixed $sefMode
     */
    public function setSefMode($sefMode): void {
        $this->sefMode = $sefMode;
    }
}