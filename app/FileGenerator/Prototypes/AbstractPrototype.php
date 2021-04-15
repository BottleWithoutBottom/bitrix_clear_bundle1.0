<?php

namespace App\FileGenerator\Prototypes;

use App\FileGenerator\Stubs\AbstractStub;

abstract class AbstractPrototype
{
    protected $stub;

    protected function getStub()
    {
        return $this->stub;
    }

    protected function setStub(AbstractStub $stub)
    {
        $this->setStub($stub);
    }

    protected function processStub()
    {

    }
}