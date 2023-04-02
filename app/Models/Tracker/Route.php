<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Route extends Base
{
    protected $table = 'tracker_routes';

    protected $fillable = [
        'name',
        'action',
    ];

    public function paths()
    {
        return $this->hasMany($this->getConfig()->get('route_path_model'));
    }
}
