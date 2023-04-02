<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class QueryArgument extends Base
{
    protected $table = 'tracker_query_arguments';

    protected $fillable = [
        'query_id',
        'argument',
        'value',
    ];
}
