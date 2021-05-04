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
    public CONST GENERATED_NAMESPACE = 'generatedNamespace';
    public CONST GENERATED_PARENT_CLASS_NAME = 'generatedParentClass';
    public CONST GENERATED_PARENT_NAMESPACE = 'generatedParentNamespace';

    public function execute($params)
    {
        if ($this->initGeneratedPrototype($params)) {
            if ($this->generator->generate()) {
                if (
                    $this->generator->placeFile(
                    $this->generator->getGeneratedFullFilePath(),
                    $this->generator->getStubString()
                    )
                ) {
                    if ($this->initPrototype($params)) {
                        if ($this->generator->generate()) {
                            $this->generator->placeFile(
                                $this->generator->getFullFilePath(),
                                $this->generator->getStubString()
                            );
                        }
                    }
                }

            }
        }
    }

    private function initPrototype($params)
    {
        if (empty($params)) return false;

        $this->prototype->setSymbolCode($params[static::SYMBOL_CODE]);
        $this->prototype->setClassNameBySymbolCode();
        $this->generator->setCommentIsDemanded(false);
        $this->prototype->setNamespace($params[static::NAMESPACE]);
        $this->prototype->setParentNamespace($params[static::GENERATED_PARENT_NAMESPACE]);
        $this->prototype->setParentClass($params[static::GENERATED_PARENT_CLASS_NAME]);
        return true;
    }

    private function initGeneratedPrototype($params)
    {
        if (empty($params)) return false;
        $this->prototype->setSymbolCode($params[static::SYMBOL_CODE]);
        $this->generator->setCommentIsDemanded(true);
        $this->prototype->setComment($this->prototype->generated());
        $this->prototype->setClassNameBySymbolCode();
        $this->prototype->setNamespace($params[static::GENERATED_NAMESPACE]);
        $this->prototype->setParentNamespace($params[static::PARENT_NAMESPACE]);
        $this->prototype->setParentClass($params[static::PARENT_CLASS_NAME]);
        $this->prototype->setInfoblockId($params[static::IBLOCK_ID]);
        $this->prototype->setBitrixProperties($params[static::PROPERTIES]);
        return true;
    }
}