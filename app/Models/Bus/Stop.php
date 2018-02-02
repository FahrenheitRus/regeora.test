<?php

namespace App\Models\Bus;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    /**
     * @var integer
     */
    public $st_id;

    /**
     * @var integer
     */
    public $time_minute;

    /**
     * @var integer
     */
    public $distance_to_next;

    /**
     * @var integer
     */
    public $event_id;
    /**
     * @var integer
     */
    public $kp;

    protected $fillable = [
        'kp',
        'distance_to_next',
        'time_minute',
        'st_id',
        'event_id',
    ];


    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public static function getIndustrialStopsBetween($start_minute, $from_minute)
    {
        return static::whereHas('events', function($query) {
            $query->where('is_industrial', 1);
        })
            ->where('time_minute', '<=', $from_minute)
            ->where('time_minute', '>=', $start_minute)
            ->get();
    }

    public static function getIndustrialStopsBetweenWithNames($start_minute, $from_minute)
    {
        return static::whereHas('events', function($query) {
            $query->where('is_industrial', 1);
        })
            ->join('stop_points','stops.st_id','=','stop_points.id')
            ->where('time_minute', '<=', $from_minute)
            ->where('time_minute', '>=', $start_minute)
            ->get();
    }
}