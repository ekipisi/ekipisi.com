<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialModel extends Model
{
    protected $table = 'user_socials';

    protected $fillable = [
        'user_id', 'facebook_id', 'google_id', 'twitter_id'
    ];

}
