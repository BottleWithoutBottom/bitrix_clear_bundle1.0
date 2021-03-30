<?php

namespace Letsrock\Lib\Models;
use Bitrix\Highloadblock\HighloadBlockTable;

abstract class HLModel
{
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
}