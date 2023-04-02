<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class RoutePathParameter extends Base
{
    protected $table = 'tracker_route_path_parameters';

    protected $fillable = [
        'route_path_id',
        'parameter',
        'value',
    ];
}
