<?php

namespace App\MVC\Models\Highload;
use App\MVC\Models\Model;
use Bitrix\Highloadblock\HighloadBlockTable;

abstract class HLModel extends Model
{
    public CONST UF_ACTIVE = 'UF_ACTIVE';
    public CONST UF_SORT = 'UF_SORT';
    public CONST UF_XML_ID = 'UF_XML_ID';

    protected $hlEntity;
    protected static $HL_ID;

    protected function setHlEntity()
    {
        if (!empty($this->hlEntity) || empty(static::$HL_ID)) return false;

        $this->hlEntity = $this->getEntity();
        return true;
    }

    protected function getHlEntity()
    {
        if (empty($this->hlEntity)) $this->setHlEntity();

        return $this->hlEntity;
    }

    public function fetch($order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        return $this->getHlEntity()::getList(
            [
                'select' => $select,
                'filter' => $filter,
                'order' => $order,
            ]
        )->fetch();
    }

    public function fetchAll($order = ['ID' => 'ASC'], $filter = [], $select = ['*'])
    {
        return $this->getHlEntity()::getList(
            [
                'select' => $select,
                'filter' => $filter,
                'order' => $order,
            ]
        )->fetchAll();
    }

    private function getEntity()
    {
        \CModule::IncludeModule('highloadblock');
        $hlblock = HighloadBlockTable::getById(static::$HL_ID)->fetch();
        $entity = HighloadBlockTable::compileEntity($hlblock);
        return $entity->getDataClass();
    }

    public static function getActiveFilter()
    {
        return [static::UF_ACTIVE => 1];
    }

    public static function getDefaultOrder()
    {
        return ['ID' => 'ASC'];
    }
}