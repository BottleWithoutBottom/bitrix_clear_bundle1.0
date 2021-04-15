<?php

namespace App\FileGenerator\Prototypes;
use App\FileGenerator\Stubs\AbstractStub;

abstract class AbstractPrototype
{
    protected $stubString;

    protected function getStubString(): string
    {
        return $this->stubString;
    }

    public function setStubString($string): bool
    {
        if (empty($string)) return false;

        $this->stubString = $string;

        return true;
    }
}