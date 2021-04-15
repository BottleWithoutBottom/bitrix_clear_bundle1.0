<?php

namespace App\FileGenerator\Prototypes;

class BitrixInfoblockPrototype extends BitrixModelPrototype
{
    protected string $className;
    protected string $namespace;
    protected string $parentClassname;
    protected string $parentNamespace;
    protected array $bitrixProperties;

    /**
     * @return array
     */
    public function getBitrixProperties(): array {
        return $this->bitrixProperties;
    }

    /**
     * @param array $bitrixProperties
     */
    public function setBitrixProperties(array $bitrixProperties): void {
        $this->bitrixProperties = $bitrixProperties;
    }

    // собирает названия свйоств инфоблока и помещает их в константы
    public function processBitrixProperties()
    {
        if (!empty($this->getBitrixProperties()))
        {
            $finalString = '/n';
            $publicConst = 'public CONST';
            foreach($this->getBitrixProperties() as $property)
            {
                $string = $publicConst . ' ' . mb_strtoupper($property) . ' = ' . $property . '\n';
                $finalString .= $string;
            }

            $finalString .= '\n';
        }

        return $finalString;
    }
}