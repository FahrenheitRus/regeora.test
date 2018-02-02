<?php

namespace App\Modules\Parse\Transport\Raspvariant\Object;

use App\Models\Bus\Smena;
use App\Modules\Parse\Interfaces\ConvertObjectORMInterface;
use App\Modules\Parse\Interfaces\ConvertRulesInterface;
use App\Modules\Parse\Traits\ConverterObjectTrait;
use App\Modules\Parse\Traits\RulesTrait;

class SmenaConvertObject implements ConvertRulesInterface, ConvertObjectORMInterface
{
    use ConverterObjectTrait;
    use RulesTrait;

    const CLASS_NAME = Smena::class;
    const EXT_PRIMARY = ['graph_id', 'smena'];


    const RULES = [
        'smena',
        'graph_id',
    ];
}
