<?php

namespace App\Modules\Parse\Transport\Raspvariant\Object;

use App\Models\Bus\Graph;
use App\Modules\Parse\Interfaces\ConvertObjectORMInterface;
use App\Modules\Parse\Interfaces\ConvertRulesInterface;
use App\Modules\Parse\Traits\ConverterObjectTrait;
use App\Modules\Parse\Traits\RulesTrait;

class GraphConvertObject implements ConvertRulesInterface, ConvertObjectORMInterface
{
    use ConverterObjectTrait;
    use RulesTrait;

    const CLASS_NAME = Graph::class;
    const EXT_PRIMARY = ['num'];


    const RULES = [
        'raspvariant_id',
        'num',
        'nullRun' => [
            'convert_method' => 'convertDistanceKmToM',
            'prop' => 'nullRun',
        ],
        'lineRun' => [
            'convert_method' => 'convertDistanceKmToM',
            'prop' => 'lineRun',
        ],
        'totalRun' => [
            'convert_method' => 'convertDistanceKmToM',
            'prop' => 'totalRun',
        ],
        'nullTime',
        'lineTime',
        'otsTime',
        'totalTime',
        'garageOut' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'garageOut',
        ],
        'garageIn' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'garageIn',
        ],
        'lineBegin' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'lineBegin',
        ],
        'lineEnd' => [
            'convert_method' => 'convertTimeToMinute',
            'prop' => 'lineEnd',
        ],
    ];
}
