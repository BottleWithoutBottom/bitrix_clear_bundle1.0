<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader;
use Letsrock\Lib\Models\Highload\HLModel;


class HighloadElementsListComponent extends CBitrixComponent
{
    public CONST HIGHLOAD_MODEL_NAME = 'HIGHLOAD_MODEL_NAME';
    public CONST SELECT_FIELDS = 'SELECT_FIELDS';
    public CONST SORT_FIELD = 'SORT_FIELD';
    public CONST SORT_ORDER = 'SORT_ORDER';

    protected $HLModel;
    /**
     * @return array|mixed
     */
    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $modelSet = $this->setHLModelByName($this->arParams[static::HIGHLOAD_MODEL_NAME]);
            if ($modelSet) {
                $paramsSelect = $this->arParams[static::SELECT_FIELDS];
                $elements = $this->getHlModel()->fetchAll(
                    $this->getSort(),
                    $this->getHlModel()::getActiveFilter(),
                    $paramsSelect
                );
                if (!empty($elements)) {
                    $this->arResult['ITEMS'] = $elements;
                }
            }
        }
        $this->includeComponentTemplate();
    }

    public function getHlModel()
    {
        return $this->HLModel;
    }

    public function setHLModelByName($modelName)
    {
        if (empty($modelName)) return false;

        try {
            $model = new $modelName;
            $this->HLModel = $model;
            return true;
        } catch (\ReflectionException $e) {
            die($e->getMessage());
        }
    }

    public function getSort()
    {
        $params = $this->arParams;
        if (
            !empty($params[static::SORT_FIELD])
            && !empty($params[static::SORT_ORDER])
        ) {
            return [$params[static::SORT_FIELD] => $params[static::SORT_ORDER]];
        } else {
            return HLModel::getDefaultOrder();
        }
    }
}
?>