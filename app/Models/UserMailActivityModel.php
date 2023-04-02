<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMailActivityModel extends Model
{
    protected $table = 'user_mail_activities';

    protected $fillable = [
        'user_id', 'title', 'message', 'read'
    ];

}
