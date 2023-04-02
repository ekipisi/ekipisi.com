<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Connection extends Base
{
    protected $table = 'tracker_connections';

    protected $fillable = [
        'name',
    ];
}
