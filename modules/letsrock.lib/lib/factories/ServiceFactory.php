<?php

namespace Letsrock\Lib\Factories;

use Letsrock\Lib\Factories\Exceptions\FactoryException;

class ServiceFactory extends AbstractFactory
{
    private const NAMESPACE = 'Letsrock\Lib\Factories';
    public function create($name)
    {
        if (empty($name)) throw new FactoryException('element name is empty');
        $nameWithNamespace = self::NAMESPACE . $name;

        try {
            return new $nameWithNamespace();
        } catch (FactoryException $e) {
            die($nameWithNamespace . ' service doesn\'t exists');
        }
    }
}