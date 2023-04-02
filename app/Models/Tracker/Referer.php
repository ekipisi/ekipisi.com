<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Model;

class Referer extends Base
{
    protected $table = 'tracker_referers';

    protected $fillable = [
        'url',
        'host',
        'domain_id',
        'medium',
        'source',
        'search_terms_hash',
    ];

    public function domain()
    {
        return $this->belongsTo($this->getConfig()->get('domain_model'));
    }
}
