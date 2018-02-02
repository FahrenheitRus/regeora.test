<?php

namespace App\Modules\Parse\Interfaces;

interface ConvertRulesInterface
{
    public function getRules();

    public function getClassName();

    public function getObject(array $prop);
}
