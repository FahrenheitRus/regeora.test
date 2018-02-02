<?php

namespace App\Modules\Parse\Transport\Raspvariant\Object;

use App\Models\Bus\Stop;
use App\Modules\Parse\Interfaces\ConvertObjectORMInterface;
use App\Modules\Parse\Interfaces\ConvertRulesInterface;
use App\Modules\Parse\Traits\ConverterObjectTrait;
use App\Modules\Parse\Traits\RulesTrait;

class StopConvertObject implements ConvertRulesInterface, ConvertObjectORMInterface
{
    use ConverterObjectTrait;
    use RulesTrait;

    const EXT_PRIMARY = ['event_id', 'st_id'];

    const CLASS_NAME = Stop::class;

    const RULES = [
        'kp',
        'distanceToNext' => [
            'convert_method' => 'convertDistanceKmToM',
            'prop' => 'distance_to_next',
        ],
        'time' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'time_minute',
        ],
        'st_id' => [
            'prop' => 'st_id',
        ],
        'event_id'
    ];
}
