<?php
namespace App\Models;

use Aginev\LoginActivity\Exceptions\LoginActivityException;
use Illuminate\Database\Eloquent\Model;

class UserActivityModel extends Model
{
    const UPDATED_AT = null;

    protected $table = 'user_login_activities';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo($this->getAuthModelName(), 'user_id');
    }

}