<?php

namespace App\Events;

class IblockEvent extends Event
{
    public function createModel($arFields)
    {
        if (empty($arFields)) return false;
        while(ob_get_length()){ob_end_clean();}echo("<pre>");print_r($arFields);echo("</pre>");die();
    }
}