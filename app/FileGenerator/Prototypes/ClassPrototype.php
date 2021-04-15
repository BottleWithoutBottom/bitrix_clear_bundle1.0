<?php

namespace App\FileGenerator\Prototypes;

class ClassPrototype extends AbstractPrototype
{
    protected $namespace;
    protected $className;
    protected $properties;
    protected $methods;

    /**
     * @return string
     */
    public function getClassName() {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName($className): void {
        $this->className = $className;
    }

    /**
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @param array $properties
     */
    public function setProperties($properties): void {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getMethods() {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods($methods): void {
        $this->methods = $methods;
    }

    /**
     * @return mixed
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace($namespace): void {
        $this->namespace = $namespace;
    }
}