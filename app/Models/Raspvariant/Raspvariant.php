<?php

namespace App\Models\Raspvariant;

use App\Models\Bus\Graph;
use Illuminate\Database\Eloquent\Model;

class Raspvariant extends Model
{
    /**
     * @var string
     */
    public $snapTime;

    /**
     * @var integer
     */
    public $num;

    /**
     * @var string
     */
    public $start;

    /**
     * @var string|null
     */
    public $end;

    /**
     * @var string|null
     */
    public $dow;

    /**
     * internal ID needed
     * @var string
     */
    public $mr_id;

    /**
     * internal ID needed
     * @var string
     */
    public $mr_num;

    protected $fillable = [
        'snapTime',
        'num',
        'start',
        'end',
        'dow',
        'mr_id',
        'mr_num',
    ];


    public function graphs()
    {
        return $this->hasMany(Graph::class);
    }
}
