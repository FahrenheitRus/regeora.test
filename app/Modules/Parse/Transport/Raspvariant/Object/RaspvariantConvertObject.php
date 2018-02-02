<?php

namespace App\Modules\Parse\Transport\Raspvariant\Object;

use App\Models\Raspvariant\Raspvariant;
use App\Modules\Parse\Interfaces\ConvertObjectORMInterface;
use App\Modules\Parse\Interfaces\ConvertRulesInterface;
use App\Modules\Parse\Traits\ConverterObjectTrait;
use App\Modules\Parse\Traits\RulesTrait;

class RaspvariantConvertObject implements ConvertRulesInterface, ConvertObjectORMInterface
{
    use ConverterObjectTrait;
    use RulesTrait;

    const EXT_PRIMARY = ['mr_id', 'mr_num'];

    const CLASS_NAME = Raspvariant::class;

    const RULES = [
        'snapTime',
        'num',
        'start',
        'end' => [
            'filter' => true,
        ],
        'dow',
        'mr_id' => [
            'prop' => 'mr_id',
        ],
        'mr_num' => [
            'prop' => 'mr_num',
        ],
    ];
}
