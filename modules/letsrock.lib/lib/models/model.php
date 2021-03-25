<?php

namespace Letsrock\Lib\Models;

abstract class Model
{
    private $symbolCode;
    private $infoblockId;

    public function getSymbolCode()
    {
        return $this->symbolCode;
    }

    public function getInfoblockId()
    {
        return $this->infoblockId;
    }
}