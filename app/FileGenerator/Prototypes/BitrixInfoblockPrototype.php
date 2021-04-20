<?php

namespace App\FileGenerator\Prototypes;

class BitrixInfoblockPrototype extends BitrixModelPrototype
{
    protected string $symbolCode = '';
    protected int $infoblockId;
    protected array $bitrixProperties;

    /**
     * @return int
     */
    public function getInfoblockId(): int
    {
        return $this->infoblockId;
    }

    /**
     * @param int $infoblockId
     */
    public function setInfoblockId(int $infoblockId): void
    {
        $this->infoblockId = $infoblockId;
    }

    /**
     * @return string
     */
    public function getSymbolCode(): string
    {
        return $this->symbolCode;
    }

    /**
     * @param string $symbolCode
     */
    public function setSymbolCode(string $symbolCode): void
    {
        $this->symbolCode = $symbolCode;
    }

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