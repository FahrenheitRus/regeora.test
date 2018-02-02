<?php

namespace App\Modules\Parse\Transport\Raspvariant\Object;

use App\Models\Bus\Event;
use App\Modules\Parse\Interfaces\ConvertObjectORMInterface;
use App\Modules\Parse\Interfaces\ConvertRulesInterface;
use App\Modules\Parse\Traits\ConverterObjectTrait;
use App\Modules\Parse\Traits\RulesTrait;

class EventConvertObject implements ConvertRulesInterface, ConvertObjectORMInterface
{
    use ConverterObjectTrait;
    use RulesTrait;

    const CLASS_NAME = Event::class;
    const EXT_PRIMARY = ['smena_id', 'ext_id', 'start_minute'];


    const RULES = [
        'ev_id' => [
            'prop' => 'ext_id',
        ],
        'start' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'start_minute',
        ],
        'end' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'end_minute',
        ],
        'departureID' => [
            'prop' => 'ext_departure_id',
        ],
        'arrivalID' => [
            'prop' => 'ext_arrival_id',
        ],
        'distance' => [
            'convert_method' => 'convertDistanceKmToM',
            'prop' => 'distance',
        ],
        'duration',
        'smena_id',
        [
            'replace' => [self::class, 'is_industrial'],
            'prop' => 'is_industrial'
        ],
    ];

    public static function is_industrial(array $prop)
    {
        return $prop['ext_id'] == 4;
    }
}
