<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Domain extends Base
{
    protected $table = 'tracker_domains';

    protected $fillable = [
        'name',
    ];
}
