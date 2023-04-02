<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class RefererSearchTerm extends Base
{
    protected $table = 'tracker_referers_search_terms';

    protected $fillable = [
        'referer_id',
        'search_term',
    ];
}
