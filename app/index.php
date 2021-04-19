<?php
require('./vendor/autoload.php');
$stub = new App\FileGenerator\Stubs\BitrixInfoblockStub();

$prototype = new App\FileGenerator\Prototypes\BitrixInfoblockPrototype();
$prototype->setClass('Entity');
$classGenerator = new \App\FileGenerator\Generator\BitrixModelGenerator(
    $prototype,
    new \App\FileGenerator\Stubs\BitrixInfoblockStub()
);
while(ob_get_length()){ob_end_clean();}echo("<pre>");print_r($classGenerator->generate());echo("</pre>");die();
file_put_contents('./class.php', $stub->getStub());