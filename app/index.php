<?php
require('./vendor/autoload.php');
$stub = new App\FileGenerator\Stubs\BitrixInfoblockStub();

$stub->setStub($stub->generateStub());
file_put_contents('./class.php', $stub->getStub());