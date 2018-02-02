<?php

namespace App\Models\Bus;

use Illuminate\Database\Eloquent\Model;

class Smena extends Model
{
    public $table = 'smena';
    /**
     * @var integer
     */
    public $smena;

    /**
     * @var integer
     */
    public $graph_id;

    protected $fillable = [
        'smena',
        'graph_id',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }


}
