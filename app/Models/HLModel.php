<?php

namespace Letsrock\Lib\Models;

abstract class HLModel
{
    protected $hlEntity;
    protected static $HL_ID;

    protected function setHlEntity()
    {
        if (!empty($this->hlEntity) || empty(static::$HL_ID)) return false;

        $this->hlEntity = GetEntityDataClass(static::$HL_ID);
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
}