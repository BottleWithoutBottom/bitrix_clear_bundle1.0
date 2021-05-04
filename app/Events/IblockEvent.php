<?php

namespace App\Events;

use App\FileGenerator\Generator\BitrixInfoblockGenerator;
use App\FileGenerator\Prototypes\BitrixInfoblockPrototype;
use App\FileGenerator\Stubs\BitrixInfoblockStub;
use App\FileGenerator\GenetratorCommand\BitrixInfoblockGeneratorCommand as BitInfoblockComm;
use App\MVC\Models\Infoblock\Generated\GeneratedInfoblockModel;
use App\MVC\Models\Infoblock\InfoblockModel;

class IblockEvent extends Event
{
    public function createModel($arFields)
    {
        $symbolCode = $arFields['CODE'];

        if (!empty($symbolCode)) {
            $infoblockId = $arFields['ID'];

            $properties = IblockEvent::getPropertiesSymbolCodes($infoblockId);

//            $prototype = new BitrixInfoblockPrototype();
//            $prototype->setSymbolCode($symbolCode);
//            $prototype->setClassNameBySymbolCode();
//            $prototype->setNamespace('App\MVC\Models\Infoblock');
//            $prototype->setParentNamespace('App\MVC\Models\Infoblock');
//            $prototype->setInfoblockId($infoblockId);
//            $prototype->setBitrixProperties($properties);
//            $stub = new BitrixInfoblockStub();
            $command = new BitInfoblockComm(
                new BitrixInfoblockStub(),
                new BitrixInfoblockPrototype(),
                BitrixInfoblockGenerator::class
            );

            $infoblockModelReflection = new \ReflectionClass(new InfoblockModel());
            $generatedInfoblockModelReflection = new \ReflectionClass(new GeneratedInfoblockModel());
            $command->execute([
                BitInfoblockComm::IBLOCK_ID => $infoblockId,
                BitInfoblockComm::SYMBOL_CODE => $symbolCode,
                BitInfoblockComm::PROPERTIES => $properties,
                BitInfoblockComm::PARENT_CLASS_NAME => $infoblockModelReflection->getShortName(),
                BitInfoblockComm::NAMESPACE => $infoblockModelReflection->getNamespaceName(),
                BitInfoblockComm::PARENT_NAMESPACE => $infoblockModelReflection->getNamespaceName(),
                BitInfoblockComm::GENERATED_PARENT_NAMESPACE => $generatedInfoblockModelReflection->getNamespaceName(),
                BitInfoblockComm::GENERATED_NAMESPACE => $generatedInfoblockModelReflection->getNamespaceName(),
                BitInfoblockComm::GENERATED_PARENT_CLASS_NAME => $generatedInfoblockModelReflection->getShortName()
            ]);

//            if ($generator->generate()) {
//                $generator->placeFile(
//                    $generator->getFullFilePath(),
//                    $generator->getStubString()
//                );
//            }
        }
    }

    public function deleteModel($ID)
    {
        var_dump($ID);
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