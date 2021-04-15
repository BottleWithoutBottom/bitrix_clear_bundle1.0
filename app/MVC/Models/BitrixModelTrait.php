<?php

namespace App\Mvc\Models;

trait BitrixModelTrait
{
    public static function getDefaultOrder()
    {
        return ['ID' => 'ASC'];
    }
}