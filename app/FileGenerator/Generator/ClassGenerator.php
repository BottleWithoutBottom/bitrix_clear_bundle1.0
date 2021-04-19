<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\AbstractPrototype;
use App\FileGenerator\Prototypes\ClassPrototype;
use App\FileGenerator\Stubs\ClassStub;

class ClassGenerator extends AbstractGenerator
{
    protected $namespaceStubs = [
        '{{namespace}}', '{{ namespace }}'
    ];

    protected $classStubs = [
        '{{class}}', '{{ class }}'
    ];

    protected $parentClassStubs = [
        '{{parentClass}}', '{{ parentClass }}'
    ];

    public function __construct(ClassPrototype $prototype, ClassStub $stub)
    {
        $this->setPrototype($prototype);
        $this->setStub($stub);
    }

    public function generate()
    {
        parent::generate();
        $class = $this->getPrototype()->getClass();
        if (!empty($class)) {
            $this->placeClass($this->getPrototype());
        }
    }

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

    private function placeClass(
        AbstractPrototype $prototype
    ) {
        $class = $prototype->getClass();

        if (!empty($class)) {
            foreach ($this->classStubs as $classStub) {
                if (strrpos($this->getStubString(), $classStub)) {
                    $newStub = str_replace($classStub, $class, $this->getStubString());
                    $this->stubString = $newStub;
                    while(ob_get_length()){ob_end_clean();}echo("<pre>");print_r($newStub);echo("</pre>");die();
                    return true;
                }
            }
        }

        return false;
    }
}