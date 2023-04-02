<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackerModel extends Model
{
    protected $table = 'tracker_sessions';

    protected $fillable = [
        'uuid',
        'user_id',
        'device_id',
        'language_id',
        'agent_id',
        'client_ip',
        'cookie_id',
        'referer_id',
        'geoip_id',
        'is_robot',
    ];
    
    public function is_mobile()
    {
        return $this->device();
    }

    public function device()
    {
        return $this->belongsTo('\App\Models\Tracker\Device');
    }

    public function language()
    {
        return $this->belongsTo('\App\Models\Tracker\Language');
    }

    public function agent()
    {
        return $this->belongsTo('\App\Models\Tracker\Agent');
    }

    public function referer()
    {
        return $this->belongsTo('\App\Models\Tracker\Referer');
    }

    public function log()
    {
        return $this->hasMany('\App\Models\Tracker\Log', 'session_id');
    }

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }


    public function getPageViewsAttribute()
    {
        return $this->log()->count();
    }

}
