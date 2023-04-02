<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class SqlQuery extends Base
{
    protected $table = 'tracker_sql_queries';

    protected $fillable = [
        'sha1',
        'statement',
        'time',
        'connection_id',
    ];
}
