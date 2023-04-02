<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Language extends Base
{
    protected $table = 'tracker_languages';

    protected $fillable = ['preference', 'language-range'];
}
