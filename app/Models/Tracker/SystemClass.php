<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class SystemClass extends Base
{
    protected $table = 'tracker_system_classes';

    protected $fillable = [
        'name',
    ];
}
