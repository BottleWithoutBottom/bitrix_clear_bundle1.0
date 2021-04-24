<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    'CACHE_TIME' => [
        'TYPE' => 'STRING',
        'NAME' => 'Время кеширования',
        'DEFAULT' => 3600000
    ],
    'HIGHLOAD_MODEL_NAME' => [
        'TYPE' => 'STRING',
        'NAME' => 'Класс хайлода'
    ],
    'SELECT_FIELDS' => [
        'TYPE' => 'LIST',
        'NAME' => 'Список выбираемых полей',
    ],
    'SORT_FIELD' => [
        'TYPE' => 'STRING',
        'NAME' => 'Поле для сортировки',
    ],
    'SORT_ORDER' => [
        'TYPE' => 'STRING',
        'Порядок сортировки',
    ]
];