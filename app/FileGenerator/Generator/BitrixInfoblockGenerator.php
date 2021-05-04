<?php

namespace App\FileGenerator\Generator;

use App\FileGenerator\Prototypes\BitrixInfoblockPrototype;
use App\FileGenerator\Prototypes\ClassPrototype;
use App\FileGenerator\Stubs\BitrixInfoblockStub;
use App\FileGenerator\Stubs\ClassStub;

class BitrixInfoblockGenerator extends BitrixModelGenerator
{
    protected $generatedPath;

    protected $symbolCodeStubs = [
        '{{symbolCode}}', '{{ symbolCode }}'
    ];

    protected $infoblockIdStubs = [
        '{{infoblockId}}', '{{ infoblockId }}'
    ];

    protected $bitrixPropertiesStubs = [
        '{{bitrixProperties}}', '{{ bitrixProperties }}'
    ];

    public function __construct(
        ClassPrototype $prototype,
        ClassStub $stub
    ) {
        parent::__construct($prototype, $stub);

        $this->path = $this->path . 'Infoblock/';
        $this->generatedPath = $this->path . 'Generated/';
    }

    public function generate(): bool
    {
        if (parent::generate()) {

            if ($this->placeSymbolCode($this->getPrototype())) {
                if ($this->placeInfoblockId($this->getPrototype())) {
                    $this->placeBitrixProperties(
                        $this->getPrototype(),
                        $this->getStub()
                    );
                }

                return true;
            }
        }

        return false;
    }

    public function setClassNameBySymbolCode()
    {
        if (!empty($this->getPrototype()->getSymbolCode())) {
            $fileName = mb_strtolower($this->getPrototype()->getSymbolCode());

            $fileName = preg_replace('^ib_', '', $fileName);
            return $this->setFileName(ucfirst($fileName));
        }

        return false;
    }

    protected function placeSymbolCode(
        BitrixInfoblockPrototype $infoblockPrototype
    ) {
        $symbolCode = $infoblockPrototype->getSymbolCode();

        if (!empty($symbolCode)) {
            foreach ($this->symbolCodeStubs as $symbolCodeStub) {
                if (strrpos($this->getStubString(), $symbolCodeStub)) {
                    $newStub = str_replace($symbolCodeStub, "'" . $symbolCode . "'", $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        }

        return false;
    }

    protected function placeBitrixProperties(
        BitrixInfoblockPrototype $prototype,
        BitrixInfoblockStub $stub
    ) {
        $propertyStub = $stub->getBitrixProperiesStub();
        $properties = $prototype->getBitrixProperties();
        $propertiesCount = count($properties);
        if ($propertiesCount) {
            $resPropertiesString = '';
            $constsCount = 0;
            foreach ($properties as $propertyCode) {
                $disablePreString = !$constsCount;
                $disableLastString = !$constsCount + 1 >= $propertiesCount;
                $property = $this->createConst(
                    $propertyCode,
                    $propertyCode,
                    'public',
                    $disablePreString,
                    $disableLastString
                );
                $resPropertiesString .= $property;
                $constsCount++;
            }
            foreach ($this->bitrixPropertiesStubs as $bitrixPropertiesStub) {
                if (strrpos($this->getStubString(), $bitrixPropertiesStub)) {
                    $newStub = str_replace($bitrixPropertiesStub, $resPropertiesString, $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }

        } else {
            if (strrpos($this->getStubString(), $propertyStub)) {
                $newStub = str_replace($propertyStub, '', $this->getStubString());
                $this->stubString = $newStub;
                return true;
            }
        }
    }

    protected function placeInfoblockId(BitrixInfoblockPrototype $prototype)
    {
        $infoblockId = $prototype->getInfoblockId();

        if (!empty($infoblockId)) {
            foreach ($this->infoblockIdStubs as $infoblockIdStub) {
                if (strrpos($this->getStubString(), $infoblockIdStub)) {
                    $newStub = str_replace($infoblockIdStub, $infoblockId, $this->getStubString());
                    $this->stubString = $newStub;
                    return true;
                }
            }
        }

        return false;
    }

    public function getGeneratedFullFilePath()
    {
        if (empty($this->getFileName()) || empty($this->getGeneratedPath())) return false;

        return $this->getGeneratedPath() . $this->getFileName() . $this->ext;
    }

    public function getGeneratedPath()
    {
        return $this->generatedPath;
    }
}