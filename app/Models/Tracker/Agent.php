<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Agent extends Base
{
    protected $table = 'tracker_agents';

    protected $fillable = [
        'name',
        'browser',
        'browser_version',
        'name_hash',
    ];
}
