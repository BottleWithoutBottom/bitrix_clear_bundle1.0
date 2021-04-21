<?php
require('./vendor/autoload.php');
$stub = new App\FileGenerator\Stubs\BitrixInfoblockStub();

$prototype = new App\FileGenerator\Prototypes\BitrixInfoblockPrototype();
$prototype->setNamespace('App\MVC\Model\Infoblock');
$prototype->setSymbolCode('IB_ADVENTURES');
$prototype->setClassNameBySymbolCode();
$prototype->setParentClass(App\MVC\Models\Infoblock\InfoblockModel::class);
$prototype->setBitrixProperties(['PRICE', 'ADVENTURES', 'PARKS']);
$prototype->setInfoblockId(1);
$classGenerator = new \App\FileGenerator\Generator\BitrixInfoblockGenerator(
    $prototype,
    new \App\FileGenerator\Stubs\BitrixInfoblockStub()
);
if ($classGenerator->generate()) {
//    $classGenerator->placeFile();
    $classGenerator->placeFile($classGenerator->getFullFilePath(), $classGenerator->getStubString());
}