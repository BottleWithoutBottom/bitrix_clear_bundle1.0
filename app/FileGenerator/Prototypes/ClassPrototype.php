<?php

namespace App\FileGenerator\Prototypes;

class ClassPrototype extends AbstractPrototype
{
    protected string $namespace;
    protected string $className;
    protected array $properties;

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName($className): void
    {
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
    public function setProperties($properties): void
    {
        $this->properties = $properties;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace($namespace): void
    {
        $this->namespace = $namespace;
    }
}