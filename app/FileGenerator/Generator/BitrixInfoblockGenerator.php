<?php

namespace App\FileGenerator\Generator;

class BitrixInfoblockGenerator extends BitrixModelGenerator
{
    protected $symbolCodeStubs = [
        '{{symbolCode}}', '{{ symbolCode }}'
    ];

    protected $infoblockIdStubs = [
        '{{infoblockId}}', '{{ infoblockId }}'
    ];

    protected $propertyCodeStubs = [
        '{{propertyCode}}', '{{ propertyCode }}'
    ];
}