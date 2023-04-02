<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Base
{
    protected $table = 'tracker_cookies';

    protected $fillable = ['uuid'];
}
