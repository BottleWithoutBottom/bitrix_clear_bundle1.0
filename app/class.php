<?php

namespace App\MVC\Model\Infoblock;


class Entity extends InfoblockModel
{
    
    /** PROPERTIES */
    public CONST PRICE = 'PRICE';
	public CONST ADVENTURES = 'ADVENTURES';
	public CONST PARKS = 'PARKS';

    /** END PROPERTIES */
    
    protected $symbolCode = 'IB_ADVENTURES';
    protected $infoblockId = 1;
}
