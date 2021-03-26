<?php

namespace Letsrock\Lib\Factories;

abstract class AbstractFactory implements FactoryInterface
{
    abstract public function create(string $name);
}