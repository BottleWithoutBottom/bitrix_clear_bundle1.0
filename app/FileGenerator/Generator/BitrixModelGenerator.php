<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\ClassPrototype;
use App\FileGenerator\Stubs\ClassStub;

class BitrixModelGenerator extends ClassGenerator
{
    public function __construct(ClassPrototype $prototype, ClassStub $stub) {
        parent::__construct($prototype, $stub);
        $this->path = $_SERVER['DOCUMENT_ROOT'] . '/local/app/MVC/Models/';
    }

    public function generate(): bool
    {
        return parent::generate();
    }

}