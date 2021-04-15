<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\ClassPrototype;
use App\FileGenerator\Stubs\ClassStub;

class ClassGenerator extends AbstractGenerator
{
    public function __construct(ClassPrototype $prototype, ClassStub $stub)
    {
        $this->setPrototype($prototype);
        $this->setStub($stub);
    }

    protected $namespaceStubs = [
        '{{namespace}}', '{{ namespace }}'
    ];

    protected $classStubs = [
        '{{class}}', '{{ class }}'
    ];

    protected $parentClassStubs = [
        '{{parentClass}}', '{{ parentClass }}'
    ];

    protected function generateNamespace($stub)
    {
        $namespace = $this->getPrototype()->getNamespace();

        if (!empty($namespace)) {
            $this->setNamespace($stub, $namespace);
        }

        return $this;
    }

    protected function setNamespace(string $stub, string $namespace): bool
    {
        if (empty($stub) || empty($namespace)) return false;

        foreach ($this->namespaceStubs as $stubVariant) {
            $stub = str_replace($stubVariant, $namespace, $stub);
        }

        $this->getPrototype()->setStubString($stub);
        return true;
    }


    protected function generateClass($stub)
    {
        $class = $this->getPrototype()->getClass();

        if (!empty($class)) {
            $this->setClass($stub, $class);
        }
    }
}