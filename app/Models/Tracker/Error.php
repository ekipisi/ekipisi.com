<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Error extends Base
{
    protected $table = 'tracker_errors';

    protected $fillable = [
        'message',
        'code',
    ];
}
