<?php
require('./vendor/autoload.php');
$stub = new App\FileGenerator\Stubs\BitrixInfoblockStub();

$prototype = new App\FileGenerator\Prototypes\BitrixInfoblockPrototype();
$prototype->setClass('Entity');
$prototype->setNamespace('App\MVC\Model\Infoblock');
$prototype->setSymbolCode('IB_ADVENTURES');
$prototype->setParentClass('InfoblockModel');
$prototype->setBitrixProperties(['PRICE', 'ADVENTURES', 'PARKS']);
$prototype->setInfoblockId(1);
$classGenerator = new \App\FileGenerator\Generator\BitrixInfoblockGenerator(
    $prototype,
    new \App\FileGenerator\Stubs\BitrixInfoblockStub()
);
while(ob_get_length()){ob_end_clean();}echo("<pre>");print_r($classGenerator->getPath());echo("</pre>");die();
if ($classGenerator->generate()) {
    file_put_contents('./class.php', $classGenerator->getStubString());
}