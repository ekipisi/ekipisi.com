<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Device extends Base
{
    protected $table = 'tracker_devices';

    protected $fillable = [
        'kind',
        'model',
        'platform',
        'platform_version',
        'is_mobile',
    ];
}
