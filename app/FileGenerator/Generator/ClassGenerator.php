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

    protected $parentNamespaceStubs = [
        '{{parentNamespace}}', '{{ parentNamespace }}'
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

        $namespace = $this->getPrototype()->getNamespace();
        if (!empty($namespace)) {
            $this->placeNamespace($this->getPrototype());
        }
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
                    return true;
                }
            }
        }

        return false;
    }

    private function placeNamespace(
        AbstractPrototype $prototype
    ) {
        $namespace = $prototype->getNamespace();
        if (!empty($namespace)) {
            foreach ($this->namespaceStubs as $namespaceStub) {
                if (strrpos($this->getStubString(), $namespaceStub)) {
                    $newStub = str_replace($namespaceStub, $namespace, $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        }

        return false;
    }

    private function placeParentNamespace(
        AbstractPrototype $prototype
    ) {
        $parentNamespace = $prototype->getParentNamespace();

        if (!empty($parentNamespace)) {
            foreach ($this->parentNamespaceStubs as $parentNamespaceStub) {
                if (strrpos($this->getStubString(), $parentNamespaceStub)) {
                    $newStub = str_replace($parentNamespaceStub, $parentNamespace, $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        } else {
            foreach ($this->parentNamespaceStubs as $parentNamespaceStub) {
                $removalStubString = 'use ' . $parentNamespaceStub . ';';
                if (strrpos($this->getStubString(), $removalStubString)) {
                    $newStub = str_replace($removalStubString, '', $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        }

        return false;
    }

    private function placeParentClass(
        AbstractPrototype $prototype
    ) {
        $parentClass = $prototype->getParentClass();

        if (!empty($parentClass)) {
            foreach ($this->parentClassStubs as $parentClassStub) {
                if (strrpos($this->getStubString(), $parentClassStub)) {
                    $newStub = str_replace($parentClassStub, $parentClass, $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        } else {
            foreach ($this->parentClassStubs as $parentClassStub) {
                $removalStubString = ' extends ' . $parentClassStub;
                if (strrpos($this->getStubString(), $removalStubString)) {
                    $newStub = str_replace($removalStubString, '', $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        }

        return false;
    }
}