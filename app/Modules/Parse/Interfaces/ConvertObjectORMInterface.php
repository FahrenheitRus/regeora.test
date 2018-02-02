<?php

namespace App\Modules\Parse\Interfaces;

interface ConvertObjectORMInterface
{
    //const DO_NOT_STRIP = true;

    public function getPreparedObject($prop);
}