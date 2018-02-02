<?php

namespace App\Models\Bus;

use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    /**
     * @var integer
     */
    public $num;

    /**
     * @var integer
     */
    public $nullRun;

    /**
     * @var integer
     */
    public $lineRun;

    /**
     * @var integer
     */
    public $totalRun;

    /**
     * @var integer
     */
    public $nullTime;


    /**
     * @var integer
     */
    public $lineTime;

    /**
     * @var integer
     */
    public $otsTime;

    /**
     * @var integer
     */
    public $totalTime;

    /**
     * @var integer
     */
    public $garageOut;

    /**
     * @var integer
     */
    public $garageIn;

    /**
     * @var integer|
     */
    public $lineBegin;

    /**
     * @var integer
     */
    public $lineEnd;

    /**
     * @var integer
     */
    public $raspvariant_id;

    protected $fillable = [
        'raspvariant_id',
        'num',
        'nullRun',
        'lineRun',
        'totalRun',
        'nullTime',
        'lineTime',
        'otsTime',
        'totalTime',
        'garageOut',
        'garageIn',
        'lineBegin',
        'lineEnd',
    ];

    public function smena()
    {
        return $this->hasMany(Smena::class)->orderBy('smena');
    }

    public function getRaspEventCount()
    {
        return $this
            ->smena()
            ->select(\DB::raw('count(smena.id) as count'))
            ->join('events', 'events.smena_id', 'smena.id')
            ->where('events.is_industrial', 1)
            ->first()
            ->count;
    }

    public function getRaspTimeCount()
    {
        return $this
            ->smena()
            ->select(\DB::raw('sum(events.end_minute - events.start_minute) as minute'))
            ->join('events', 'events.smena_id', 'smena.id')
            ->where('events.is_industrial', 1)
            ->first()
            ->minute;
    }
}
