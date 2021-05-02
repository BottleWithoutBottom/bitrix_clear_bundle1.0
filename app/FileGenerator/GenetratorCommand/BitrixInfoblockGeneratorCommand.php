<?php

namespace App\FileGenerator\GenetratorCommand;

class BitrixInfoblockGeneratorCommand extends AbstractGeneratorCommand
{
    public CONST SYMBOL_CODE = 'symbolCode';
    public CONST IBLOCK_ID = 'iblockId';
    public CONST NAMESPACE = 'namespace';
    public CONST PROPERTIES = 'properties';
    public CONST PARENT_NAMESPACE = 'parentNamespace';
    public CONST PARENT_CLASS_NAME = 'parentClass';

    public function execute($params)
    {
        while(ob_get_length()){ob_end_clean();}echo("<pre>");print_r();echo("</pre>");die();
    }
}