<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\AbstractPrototype;
use App\FileGenerator\Stubs\AbstractStub;

class AbstractGenerator implements GeneratorInterface
{
    protected AbstractStub $stub;
    protected AbstractPrototype $prototype;

    public function getStub() {
        return $this->stub;
    }

    public function generateStub(): string
    {
        return $this->getStub()->generateStub();
    }

    public function setStub($stub): void
    {
        $this->stub = $stub;
    }

    public function getPrototype()
    {
        return $this->prototype;
    }

    public function setPrototype($prototype): void
    {
        $this->prototype = $prototype;
    }
}