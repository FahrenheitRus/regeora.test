<?php

namespace App\Modules\Parse\Traits;

use App\Modules\Parse\Converter;

trait RulesTrait
{
    private $rules;

    public function getRules()
    {
        $converter = new Converter;

        if (!$this->rules) {
            $this->rules = $converter->getPreparedRules(static::RULES);
        }

        return $this->rules;
    }

    public function getClassName()
    {
        return static::CLASS_NAME;
    }

}
