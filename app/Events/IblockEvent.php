<?php

namespace App\Events;

use App\FileGenerator\Generator\BitrixInfoblockGenerator;
use App\FileGenerator\Prototypes\BitrixInfoblockPrototype;
use App\FileGenerator\Stubs\BitrixInfoblockStub;

class IblockEvent extends Event
{
    public function createModel($arFields)
    {
        if (empty($arFields)) return false;

        $symbolCode = $arFields['CODE'];

        if (!empty($symbolCode)) {
            $infoblockId = $arFields['ID'];

            $properties = IblockEvent::getPropertiesSymbolCodes($infoblockId);

            $prototype = new BitrixInfoblockPrototype();
            $prototype->setSymbolCode($symbolCode);
            $prototype->setClassNameBySymbolCode();
            $prototype->setNamespace('App\MVC\Models\Infoblock');
            $prototype->setParentNamespace('App\MVC\Models\Infoblock');
            $prototype->setInfoblockId($infoblockId);
            $prototype->setBitrixProperties($properties);
            $stub = new BitrixInfoblockStub();

            $generator = new BitrixInfoblockGenerator(
                $prototype,
                $stub
            );

            if ($generator->generate()) {
                $generator->placeFile(
                    $generator->getFullFilePath(),
                    $generator->getStubString()
                );
            }
        }

        return false;
    }

    private static function getPropertiesSymbolCodes($infoblockId)
    {
        if (empty($infoblockId)) return [];

        $properties = \CIBlockProperty::GetList(
            ['ID' => 'ASC'],
            [
                'ACTIVE' => 'Y',
                'IBLOCK_ID' => $infoblockId
            ],
        );

        $res = [];
        while ($propRow = $properties->GetNext()) {
            $res[] = $propRow['CODE'];
        }

        return $res;
    }
}