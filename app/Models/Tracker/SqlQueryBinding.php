<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class SqlQueryBinding extends Base
{
    protected $table = 'tracker_sql_query_bindings';

    protected $fillable = [
        'sha1',
        'serialized',
    ];
}
