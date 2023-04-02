<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Path extends Base
{
    protected $table = 'tracker_paths';

    protected $fillable = [
        'path',
    ];
}
